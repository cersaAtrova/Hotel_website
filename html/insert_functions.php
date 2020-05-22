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
function update_total_guest_reservation($people, $qnt, $resv_reference)
{
    global $db;
    $query = 'UPDATE Resv_total_guest
              SET rtg_people=:people,
                  rtg_qnt=:qnt
              WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':people', $people);
        $prep->bindValue(':qnt', $qnt);
        $prep->bindValue(':id', $resv_reference);
        $prep->execute();
        $prep->closeCursor();
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

function update_reservation($id, $resv_meal, $resv_type, $member_id, $rm_type)
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
    global $db;
    $query = 'UPDATE Reservation
                SET resv_check_in=:checkin,
                    resv_check_out=:checkout,
                    resv_meal_level=:meal,
                    resv_type=:btype,
                    resv_status=:stats,
                    member_id=:member,
                    rm_type=:rmtype
                WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $id);
        $prep->bindValue(':checkin', $check_in);
        $prep->bindValue(':checkout', $check_out);
        $prep->bindValue(':meal', $resv_meal);
        $prep->bindValue(':btype', $resv_type);
        $prep->bindValue(':stats', 'Confirm');
        $prep->bindValue(':member', $member_id);
        $prep->bindValue(':rmtype', $rm_type);
        $prep->execute();
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
function update_daily_rate($resv_reference, $date, $price)
{
    global $db;
    $query = 'UPDATE Daily_rate
                     dr_date=:cdate,
                     dr_price=:price
              WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $resv_reference);
        $prep->bindValue(':cdate', $date);
        $prep->bindValue(':price', $price);
        $prep->execute();
        $prep->closeCursor();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//=======================
//Member account function
//=======================

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
function update_member($id, $name, $last, $email, $country, $passwd, $tel)
{
    $hash = password_hash($passwd, PASSWORD_BCRYPT);

    global $db;
    $query = 'UPDATE LOW_PRIORITY Member
            SET
            member_name= :mname,
            member_last= :mlast,
            member_email= :email,
            member_country= :country,
            member_password= :passwd,
            member_tel= :tel
            WHERE member_id =:id';
    $prep = $db->prepare($query);
    $prep->bindValue(":mname", $name);
    $prep->bindValue(":mlast", $last);
    $prep->bindValue(":email", $email);
    $prep->bindValue(":country", $country);
    $prep->bindValue(":passwd", $hash);
    $prep->bindValue(":tel", $tel);
    $prep->bindValue(":id", $id);
    $prep->execute();
    $prep->closeCursor();
}
function update_member_password($id, $passwd)
{
    $hash = password_hash($passwd, PASSWORD_BCRYPT);
    global $db;
    $query = 'UPDATE Member
            SET member_password= :passwd
            WHERE member_id =:id';

    $prep = $db->prepare($query);
    $prep->bindValue(":passwd", $hash);
    $prep->bindValue(":id", $id);
    $prep->execute();
    $prep->closeCursor();
}
function get_reservation_by_member_id($id)
{
    global $db;
    $query = ' SELECT * FROM Reservation
               WHERE member_id=?
               ORDER BY resv_check_in DESC';
    $prep = $db->prepare($query);
    $prep->bindValue(1, $id);
    $prep->execute();
    $resv = $prep->fetchall();
    $prep->closeCursor();
    return $resv;
}
function get_reservation_price($id)
{
    global $db;
    $query = 'SELECT SUM(dr_price)
              FROM Daily_rate
              WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $id);
    $prep->execute();
    $total = $prep->fetch();
    $prep->closeCursor();
    return $total;
}
function get_reservation_facilities_price($id)
{
    global $db;
    $query = 'SELECT sum(fa_price)
            FROM Facility
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $id);
    $prep->execute();
    $total = $prep->fetch();
    $prep->closeCursor();
    return $total;
}
function get_member_by_id($member_id)
{
    global $db;
    $query = ' SELECT * FROM Member
               WHERE member_id=?';
    $prep = $db->prepare($query);
    $prep->bindValue(1, $member_id);
    $prep->execute();
    $member = $prep->fetch();

    $prep->closeCursor();
    return $member;
}
function insert_guest_reservation($id, $name, $last, $country, $tel)
{

    global $db;
    $query = 'INSERT INTO Guest_reservation() 
              VALUES(:id,:fname,:lname,:country,:tel)';
    $prep = $db->prepare($query);
    try {

        $prep->bindValue(':id', $id);
        $prep->bindValue(':fname', $name);
        $prep->bindValue(':lname', $last);
        $prep->bindValue(':country', $country);
        $prep->bindValue(':tel', $tel);
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
function get_facilities($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Facility
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}
function get_preferences($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Preferences
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}
function get_allergies($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Allergy
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}
function get_reservation_by_resv_id($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Reservation
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetch();
    $prep->closeCursor();
    return $fa;
}
function get_reservation_by_check_in($check_in, $check_in_to = null, $status = null)
{

    if ($status == null) {
        $status = "Confirm|Cancelled";
    }

    if ($check_in_to == null) {
        $check_in_to = $check_in;
    }


    global $db;
    $query = 'SELECT *
            FROM Reservation
            WHERE resv_check_in>=?
            AND resv_check_in<=?
            AND resv_status REGEXP ?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $check_in->format('Y-m-d'));
    $prep->bindValue(2, $check_in_to->format('Y-m-d'));
    $prep->bindValue(3, $status);
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}
function get_reservation_by_check_out($check_out, $check_out_to = null, $status = null)
{
    if ($status == null) {
        $status = "Confirm|Cancelled";
    }
    if ($check_out_to == null) {
        $check_out_to = $check_out;
    }

    global $db;
    $query = 'SELECT *
            FROM Reservation
            WHERE resv_check_out>=?
            AND resv_check_out<=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $check_out->format('Y/m/d'));
    $prep->bindValue(2, $check_out_to->format('Y/m/d'));
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}
function get_reservation_by_day_booked($day_book, $day_book_to = null, $status = null)
{
    if ($status == null) {
        $status = "Confirm|Cancelled";
    }
    if ($day_book_to == null) {
        $date = (new DateTime($day_book))->add(new DateInterval("P1D"));
    } else {
        $date = (new DateTime($day_book_to))->add(new DateInterval("P1D"));
    }

    global $db;
    $query = 'SELECT *
            FROM Reservation
            WHERE resv_check_out>=?
            AND resv_check_out<=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $day_book->format('Y/m/d'));
    $prep->bindValue(2, $date->format('Y/m/d'));
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}

function get_credit_card_by_resv_id($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Credit_card
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetch();
    $prep->closeCursor();
    return $fa;
}

function get_total_guest($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Resv_total_guest
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetchAll();
    $prep->closeCursor();
    return $fa;
}
function get_reservation_guest_profile($resv_id)
{
    global $db;
    $query = 'SELECT *
            FROM Guest_reservation
            WHERE resv_reference=?';

    $prep = $db->prepare($query);
    $prep->bindValue(1, $resv_id);
    $prep->execute();
    $fa = $prep->fetch();
    $prep->closeCursor();
    return $fa;
}
function update_guest_profile_reservation($resv_id, $name, $last, $country, $tel)
{
    global $db;
    $query = 'UPDATE Guest_reservation
                     resv_name=:cname,
                     resv_last=:clast,
                     resv_country=:country,
                     resv_tel=:tel
              WHERE resv_reference=:id';

    $prep = $db->prepare($query);
    $prep->bindValue(':id', $resv_id);
    $prep->bindValue(':cname', $name);
    $prep->bindValue(':clast', $last);
    $prep->bindValue(':country', $country);
    $prep->bindValue(':tel', $tel);
    $prep->execute();
    $prep->closeCursor();
    
}


function update_allergies($resv_reference, $alergy)
{
    global $db;
    $query = 'UPDATE Allergy
                    allergy_name=:aname
              WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $resv_reference);
        $prep->bindValue(':aname', $alergy);
        $prep->execute();
        $prep->closeCursor();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function update_preferences($resv_reference, $preferences)
{
    global $db;
    $query = 'UPDATE Preferences
                    pre_name=:aname
              WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $resv_reference);
        $prep->bindValue(':aname', $preferences);
        $prep->execute();
        $prep->closeCursor();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function update_facility($resv_reference, $name, $price)
{
    global $db;
    $query = 'UPDATE Preferences
                    fa_name=:aname
                    fa_price=:price
              WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $resv_reference);
        $prep->bindValue(':aname', $name);
        $prep->bindValue(':price', $price);
        $prep->execute();
        $prep->closeCursor();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
function update_status_reservation($resv_id, $status)
{
    global $db;
    $query = 'UPDATE LOW_PRIORITY Reservation 
              SET resv_status = :stats
              WHERE resv_reference =:id';

    $prep = $db->prepare($query);
    $prep->bindValue(':id', $resv_id);
    $prep->bindValue(':stats', $status);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}
function update_availability($rm_type, $date, $days,$status='Open')
{
    global $db;
    $query = 'UPDATE Room_availability 
              SET ra_days= :cdays,
                  ra_status=:cstatus
              WHERE rm_type =:id 
              AND ra_date=:dates';

    $prep = $db->prepare($query);
    $prep->bindValue(':id', $rm_type);
    $prep->bindValue(':dates', $date);
    $prep->bindValue(':cdays', $days);
    $prep->bindValue(':cstatus', $status);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}
function update_credit_card($resv_reference, $name, $number, $moth, $year, $cvv, $status = null)
{
    if ($status == null) {
        $status = 'Valid';
    }
    global $db;
    $query = 'UPDATE Credit_card
              SET cc_full_name=:fname,
                  cc_card_number=:ncard,
                  cc_exp_moth=:moth,
                  cc_exp_year=:eyear,
                  cc_card_cvv=:cvv,
                  cc_card_status=:stats
              WHERE resv_reference=:id';
    $prep = $db->prepare($query);
    try {
        $prep->bindValue(':id', $resv_reference);
        $prep->bindValue(':fname', $name);
        $prep->bindValue(':ncard', $number);
        $prep->bindValue(':moth', $moth);
        $prep->bindValue(':eyear', $year);
        $prep->bindValue(':cvv', $cvv);
        $prep->bindValue(':stats', $status);
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
function update_room_rate($date, $rm_price, $extra_person, $kids_price)
{
    global $db;
    $query = 'UPDATE LOW_PRIORITY Room_rate 
              SET rr_price= :rmprice,
                  rr_extra_person= :exprice,
                  rr_kids= :kprice
              WHERE rr_date=:dates';

    $prep = $db->prepare($query);
    $prep->bindValue(':rmprice', $rm_price);
    $prep->bindValue(':exprice', $extra_person);
    $prep->bindValue(':kprice', $kids_price);
    $prep->bindValue(':dates', $date);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}

function update_room_constraint($rm_type, $date, $days)
{
    global $db;
    $query = 'UPDATE LOW_PRIORITY Room_constraint
              SET rc_days= :cdays
              WHERE rm_type =:id 
              AND rc_date=:dates';

    $prep = $db->prepare($query);
    $prep->bindValue(':id', $rm_type);
    $prep->bindValue(':dates', $date);
    $prep->bindValue(':cdays', $days);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}

function insert_room_constraint($rm_type, $date)
{
    global $db;
    $query = 'INSERT INTO Room_constraint()
              VALUES(:dates,:id,:cdays)';

    $prep = $db->prepare($query);
    $prep->bindValue(':id', $rm_type);
    $prep->bindValue(':dates', $date);
    $prep->bindValue(':cdays', 1);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}
function insert_room_rate($date, $rm_price, $extra_person, $kids_price)
{
    global $db;
    $query = 'INSERT INTO Room_rate()
              VALUES(:dates,:rmprice,:exprice,:kprice)';

    $prep = $db->prepare($query);
    $prep->bindValue(':rmprice', $rm_price);
    $prep->bindValue(':exprice', $extra_person);
    $prep->bindValue(':kprice', $kids_price);
    $prep->bindValue(':dates', $date);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}
function insert_room_availability($date, $rm_type)
{
    global $db;
    $query = 'INSERT INTO Room_availability()
              VALUES(:dates,:id,:cdays,:stats)';

    $prep = $db->prepare($query);
    $prep->bindValue(':id', $rm_type);
    $prep->bindValue(':dates', $date);
    $prep->bindValue(':cdays', 0);
    $prep->bindValue(':stats', 'Open');
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}


function get_all_meal_price()
{
    // 
    global $db;
    $query = 'SELECT * FROM Room_meal_price ORDER BY rm_price_diff';
    $prep = $db->prepare($query);
    $prep->execute();
    $re = $prep->fetchAll();
    $prep->closeCursor();
    return $re;
}

function update_meal_price($meal, $price, $kids_price)
{
    global $db;
    $query = 'UPDATE LOW_PRIORITY Room_meal_price
              SET rm_price_diff= :price,
                  rm_kids_price= :kids
              WHERE rm_meal=:meal';

    $prep = $db->prepare($query);
    $prep->bindValue(':meal', $meal);
    $prep->bindValue(':price', $price);
    $prep->bindValue(':kids', $kids_price);
    if ($prep->execute()) {
        $prep->closeCursor();
        return true;
    }
    $prep->closeCursor();
    return false;
}
