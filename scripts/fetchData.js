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

async function fetchData(url, options) {
    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }

    return fetch(url, options)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
            console.log(data);
        });
}

function getUnpaidsPerMonth(leftBound, rightBound) {
    console.log("Fetching via getUnpaidsPerMonth()");

    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";

    return fetchData(`../api/unpaidsPerMonth.php?token=${getCookie("cnxToken")}${left}${right}${nS}${rS}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

function getUnpaidsForEach(leftBound, rightBound, orderby, nImpaye, nSIREN, raisonSociale) {
    console.log("Fetching via getUnpaidsForEach()");

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";
    let order = orderby !== "" ? '&orderby=' + orderby : "";
    let nImp = nImpaye !== "" ? '&nImp=' + nImpaye : "";
    let nS = nSIREN !== "" ? '&nSIREN=' + nSIREN : "";
    let rS = raisonSociale !== "" ? '&raisonSociale=' + raisonSociale : "";

    console.log(`../api/unpaidsForEach.php?token=${getCookie("cnxToken")}${left}${right}${order}${nImp}${nS}${rS}`);
    return fetchData(`../api/unpaidsForEach.php?token=${getCookie("cnxToken")}${left}${right}${order}${nImp}${nS}${rS}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

function getUnpaidReasons(leftBound, rightBound) {
    console.log("Fetching via getUnpaidReasons()");

    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value !== "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";

    return fetchData(`../api/unpaidReasons.php?token=${getCookie("cnxToken")}${left}${right}${nS}${rS}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

function getTreasury() {
    console.log("Fetching via getTreasury()");

    let order = (document.getElementById("order-by") && document.getElementById("order-by").value !== "") ? '&orderby=' + document.getElementById("order-by").value : "";
    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";

    return fetchData(`../api/treasuryForEach.php?token=${getCookie("cnxToken")}${nS}${order}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

function getTreasuryPerMonth(leftBound, rightBound) {
    console.log("Fetching via getTreasuryPerMonth()");

    let left = leftBound !== "" ? '&leftBound=' + leftBound : "";
    let right = rightBound !== "" ? '&rightBound=' + rightBound : "";
    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value !== "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";

    console.log(`../api/treasuryPerMonth.php?token=${getCookie("cnxToken")}${left}${right}${nS}`);
    return fetchData(`../api/treasuryPerMonth.php?token=${getCookie("cnxToken")}${left}${right}${nS}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

function getDiscount(email, order) {
    console.log("Fetching via getDiscount()");
    let value="";

    if (document.getElementById("nSiren") && document.getElementById("nSiren").value !== "") {
        value = '&nSiren=' + document.getElementById("nSiren").value;
    }
    else if (document.getElementById("nRemise") && document.getElementById("nRemise").value !== "") {
        value = '&nRemise=' + document.getElementById("nRemise").value;
    }
    if (email !== null) {
        value = value + '&email=' + email;
    }
    value = value + '&order=' + order;
    console.log(`../api/discountForEach.php?token=${getCookie("cnxToken")}${value}`);
    return fetchData(`../api/discountForEach.php?token=${getCookie("cnxToken")}${value}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

function getDiscountDetails(nRemise) {

    let nR = nRemise !== null ? '&nRemise=' + nRemise : "";
    console.log(`../api/discountDetails.php?token=${getCookie("cnxToken")}${nR}`);
    return fetchData(`../api/discountDetails.php?token=${getCookie("cnxToken")}${nR}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    });
}

export { getUnpaidsForEach, getUnpaidsPerMonth, getUnpaidReasons, getTreasury, getTreasuryPerMonth, getDiscount, getDiscountDetails };