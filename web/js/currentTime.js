/**
 * Created by Skolem on 2017. 01. 30..
 */

function monthNameHu(ho) {

    var month = ["január", "február", "március", "április", "május",

        "junius", "július", "augusztus", "szeptember", "október", "nvember", "december"];

    return month[ho]

}

function dayNameHu(szam) {
    var napok = ["vasárnap", "hétfő", "kedd", "szerda", "csütörtök", "péntek", "szombat", "vasárnap"]

    return napok[szam]

}

function updateClock() {

    var today = new Date();

    var year = today.getFullYear();
    var monthName = monthNameHu(today.getMonth() + 1);
    var day = today.getDate();

    var dayName = dayNameHu(today.getDay());

    var secondsZero;
    var minutesZero;

    if (today.getMinutes() < 10) {
        minutesZero = "0";
    } else {
        minutesZero = "";
    }

    if (today.getSeconds() < 10) {
        secondsZero = "0";
    } else {
        secondsZero = "";
    }

    var date = year + '. ' + monthName + ' ' + day + '., ' + dayName;
    var time = today.getHours() + ":" + minutesZero + today.getMinutes() + ":" + secondsZero + today.getSeconds();
    var dateTime = date + ' ' + time;

    document.getElementById("currentDateTime").innerHTML = dateTime;

    setTimeout(updateClock, 1000);
}
updateClock();