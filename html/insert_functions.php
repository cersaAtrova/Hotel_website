<?php
require_once('../connect_dbase.php');

function random_member_id()
{
    global $db;
    $c = range('A', 'Z');
    $s = range('a', 'z');
    $n = range('0', '9');
    $mrg = array_merge($c, $n, $s);
    shuffle($mrg);
    shuffle($mrg);
    for ($i = 0; $i < 8; $i++) {
        $id .= $mrg[$i];
    }

    $query = 'SELECT member_id FROM Member WHERE member_id=:id';
    $mb_id = $db->prepare($query);
    $mb_id->bindValue(':id', $id);
    $mb_id->execute();
    $chk = $mb_id->fetch();
    $mb_id->closeCursor();

    if ($chk != null) {
        //use recursive if is exist to call again the method
        return random_member_id();
    } else {
        return $id;
    }
}
function random_reservation_id()
{
    global $db;
    $c = range('A', 'Z');
    $n = range('0', '9');
    $mrg = array_merge($c, $n);
    shuffle($mrg);
    shuffle($mrg);
    for ($i = 0; $i < 8; $i++) {
        $id .= $mrg[$i];
    }
    $query = 'SELECT resv_reference FROM Reservation WHERE resv_reference=:id';
    $mb_id = $db->prepare($query);
    $mb_id->bindValue(':id', $id);
    $mb_id->execute();
    $chk = $mb_id->fetch();
    $mb_id->closeCursor();

    if ($chk != null) {
        //use recursive if is exist to call again the method
        return random_reservation_id();
    } else {
        return $id;
    }
}


function insert_new_member($name, $last, $email, $country, $tel)
{

    // $hash = password_hash($passwd, PASSWORD_BCRYPT);

    global $db;
    $id = random_member_id();

    $query = 'INSERT INTO Member() 
              VALUES(:id,:fname,:lname,:email,:country,:passwd,:tel,1)';
    $prep = $db->prepare($query);
    try {

        $prep->bindValue(':id', $id);
        $prep->bindValue(':fname', $name);
        $prep->bindValue(':lname', $last);
        $prep->bindValue(':email', $email);
        $prep->bindValue(':country', $country);
        $prep->bindValue(':passwd', NULL);
        $prep->bindValue(':tel', $tel);
        // $prep->bindValue(8, 1);
        if ($prep->execute()) {
            $prep->closeCursor();
            return $id;
        } else {
            $prep->closeCursor();
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function insert_new_allergies($resv_reference, $alergy)
{
    global $db;
    $query = 'INSERT INTO Allergy() 
              VALUES(:id,:aname)';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $resv_reference);
        $prep->bindValue(':aname', $alergy);
        if ($prep->execute()) {
            $prep->closeCursor();
            return true;
        } else {
            $prep->closeCursor();
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function insert_new_preference($resv_reference, $preference)
{
    global $db;
    $query = 'INSERT INTO Preferences(pre_name,resv_reference) 
              VALUES(?,?)';
    $prep = $db->prepare($query);
    try {

        $prep->bindValue(1, $preference);
        $prep->bindValue(2, $resv_reference);
        if ($prep->execute()) {
            $prep->closeCursor();
            return true;
        } else {
            $prep->closeCursor();
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function insert_new_facilities($facility, $price, $resv_reference)
{
    global $db;
    $query = 'INSERT INTO Facility(fa_name,fa_price,resv_reference) 
              VALUES(:aname,:price,:id)';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':aname', $facility);
        $prep->bindValue(':price', $price);
        $prep->bindValue(':id', $resv_reference);
        if ($prep->execute()) {
            $prep->closeCursor();
            return true;
        } else {
            return false;
            $prep->closeCursor();
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function insert_credit_card($resv_reference, $name, $number, $moth, $year, $cvv)
{
    global $db;
    $query = 'INSERT INTO Credit_card(resv_reference,cc_full_name,cc_card_number,cc_exp_moth,cc_exp_year,cc_card_cvv,cc_card_status) 
              VALUES(?,?,?,?,?,?,?)';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(1, $resv_reference);
        $prep->bindValue(2, $name);
        $prep->bindValue(3, $number);
        $prep->bindValue(4, $moth);
        $prep->bindValue(5, $year);
        $prep->bindValue(6, $cvv);
        $prep->bindValue(7, 'Valid');
        if ($prep->execute()) {
            return true;
            $prep->closeCursor();
        } else {
            $prep->closeCursor();
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function insert_guest($people, $qnt, $resv_reference)
{
    global $db;
    $query = 'INSERT INTO Resv_total_guest(rtg_people,rtg_qnt,resv_reference) 
              VALUES(?,?,?)';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(1, $people);
        $prep->bindValue(2, $qnt);
        $prep->bindValue(3, $resv_reference);
        if ($prep->execute()) {
            $prep->closeCursor();
            return true;
        } else {
            $prep->closeCursor();
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function insert_new_reservation($id, $resv_meal, $resv_type, $member_id, $rm_type)
{
    if ($resv_meal == 'BB') {
        $resv_meal = 'Bed & Breakfast';
    } elseif ($resv_meal == 'HB') {
        $resv_meal = 'Half Board';
    } elseif ($resv_meal == 'FB') {
        $resv_meal = 'Full Board';
    } elseif ($resv_meal == 'PAI') {
        $resv_meal = 'Premium All Inclusive';
    }
    $check_in = date('Y-m-d', strtotime($_SESSION['room_info']['check_in']));
    $check_out = date('Y-m-d', strtotime($_SESSION['room_info']['check_out']));
    $since = date("Y/m/d H-i-s");

    global $db;
    $query = 'INSERT INTO Reservation ()
    value(:id,:checkin,:checkout,:since,:meal,:btype,:stats,:member,:rmtype)';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $id);
        $prep->bindValue(':checkin', $check_in);
        $prep->bindValue(':checkout', $check_out);
        $prep->bindValue(':since', $since);
        $prep->bindValue(':meal', $resv_meal);
        $prep->bindValue(':btype', $resv_type);
        $prep->bindValue(':stats', 'Confirm');
        $prep->bindValue(':member', $member_id);
        $prep->bindValue(':rmtype', $rm_type);
        if ($prep->execute()) {
            return true;
        } else {
            return false;
        }
        return true;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function insert_into_daily_rate($resv_reference, $date, $price)
{
    global $db;
    $query = 'INSERT INTO Daily_rate(resv_reference,dr_date,dr_price) 
              VALUES(?,?,?)';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(1, $resv_reference);
        $prep->bindValue(2, $date);
        $prep->bindValue(3, $price);

        if ($prep->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function get_member($email)
{
    global $db;
    $query = ' SELECT * FROM Member
              WHERE member_email=?';
    $prep = $db->prepare($query);
    $prep->bindValue(1, $email);
    $prep->execute();
    $member = $prep->fetch();
    $prep->closeCursor();
    return $member;
}
