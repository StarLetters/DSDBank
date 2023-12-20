/*
function getCookie(name) {
    let cookieArr = document.cookie.split("; ");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name === cookiePair[0]) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}
*/
function getCnxToken() {
    return document.getElementById("token").dataset.token;
}

async function fetchData(url) {
    if (getCnxToken() === null) {
        document.location.href = "../index.html";
    }

    return fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
        .then(response => response.json())
        .then(data => {
            return data;
        })
        .catch(error => {
            console.error(error);
            console.log(data);
        });
}

function getUnpaidsPerMonth(leftBound, rightBound) {
    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";

    return fetchData(`../api/unpaidsPerMonth.php?token=${getCnxToken()}${left}${right}${nS}${rS}`);
}

function getUnpaidsForEach(leftBound, rightBound, orderby, nImpaye, nSIREN, raisonSociale) {

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";
    let order = orderby !== "" ? '&orderby=' + orderby : "";
    let nImp = nImpaye !== "" ? '&nImp=' + nImpaye : "";
    let nS = nSIREN !== "" ? '&nSIREN=' + nSIREN : "";
    let rS = raisonSociale !== "" ? '&raisonSociale=' + raisonSociale : "";

    return fetchData(`../api/unpaidsForEach.php?token=${getCnxToken()}${left}${right}${order}${nImp}${nS}${rS}`);
}

function getUnpaidReasons(leftBound, rightBound) {

    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";

    return fetchData(`../api/unpaidReasons.php?token=${getCnxToken()}${left}${right}${nS}${rS}`);
}

function getTreasury() {

    let order = (document.getElementById("order-by") && document.getElementById("order-by").value !== "") ? '&orderby=' + document.getElementById("order-by").value : "";
    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let socialReason = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";
    let dateValue = (document.getElementById("dateValeur") && document.getElementById("dateValeur").value !== "") ? '&dateValeur=' + document.getElementById("dateValeur").value : "";

    return fetchData(`../api/treasuryForEach.php?token=${getCnxToken()}${nS}${order}${socialReason}${dateValue}`);
}

function getTreasuryPerMonth(leftBound, rightBound) {
    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";
    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";

    return fetchData(`../api/treasuryPerMonth.php?token=${getCnxToken()}${left}${right}${nS}${rS}`);
}

function getDiscount(startDate, endDate, orderBy) {
    let value="";

    if (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") {
        value += '&nSiren=' + document.getElementById("nSIREN").value;
    }
    if (document.getElementById("nRemise") && document.getElementById("nRemise").value !== "") {
        value += '&nRemise=' + document.getElementById("nRemise").value;
    }
    if (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") {
        value += '&raison=' + document.getElementById("raisonSociale").value;
    }
    if (startDate !== null && startDate !== "") {
        value +='&startDate=' + startDate;
    }
    if (endDate !== null && endDate !== "") {
        value += '&endDate=' + endDate;
    }
    value += '&order=' + orderBy;
    return fetchData(`../api/discountForEach.php?token=${getCnxToken()}${value}`);
}

function getDiscountDetails(nRemise) {
    let nR = nRemise !== null ? '&nRemise=' + nRemise : "";
    return fetchData(`../api/discountDetails.php?token=${getCnxToken()}${nR}`);
}

function getReason(nSiren) {
    let nS = nSiren !== null ? "&nSiren" + nSiren : "";
    return fetchData(`../api/getReason.php?${nS}`);
}

export { getUnpaidsForEach, getUnpaidsPerMonth, getUnpaidReasons, getTreasury, getTreasuryPerMonth, getDiscount, getDiscountDetails, getReason };