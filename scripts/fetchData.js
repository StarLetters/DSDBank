function getCookie(name) {
    let cookieArr = document.cookie.split("; ");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name == cookiePair[0]) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}


function getUnpaidsPerMonth(leftBound, rightBound) {
    console.log("Fetching via getUnpaidsPerMonth()");

    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }

    let left = "";
    let right = "";

    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value != "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value != "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";

    if (leftBound !== "") { left = '&leftBound=' + leftBound }

    if (rightBound !== "") { right = '&rightBound=' + rightBound }

    return fetch('../api/unpaidsPerMonth.php?token=' + getCookie("cnxToken") + left + right + nS + rS, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
        });
}

function getUnpaidsForEach(leftBound, rightBound, orderby, nImpaye, nSIREN, raisonSociale) {
    console.log("Fetching via getUnpaidsForEach()");

    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }

    let left = "";
    let right = "";
    let order = "";
    let nImp = "";
    let nS = "";
    let rS = "";

    if (leftBound !== "") { left = '&leftBound=' + leftBound }

    if (rightBound !== "") { right = '&rightBound=' + rightBound }

    if (orderby !== "") { order = '&orderby=' + orderby }

    if (nImpaye !== "") { nImp = '&nImp=' + nImpaye }

    if (nSIREN !== "") { nS = '&nSIREN=' + nSIREN }

    if (raisonSociale !== "") { rS = '&raisonSociale=' + raisonSociale }

    console.log('../api/unpaidsForEach.php?token=' + getCookie("cnxToken") + left + right + order + nImp + nS + rS);
    return fetch('../api/unpaidsForEach.php?token=' + getCookie("cnxToken") + left + right + order + nImp + nS + rS, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
        });
}

function getUnpaidReasons(leftBound, rightBound) {
    console.log("Fetching via getUnpaidReasons()");

    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }

    let left = "";
    let right = "";

    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value != "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";
    let rS = (document.getElementById("raisonSociale") && document.getElementById("raisonSociale").value != "") ? '&raisonSociale=' + document.getElementById("raisonSociale").value : "";


    if (leftBound !== "") { left = '&leftBound=' + leftBound }

    if (rightBound !== "") { right = '&rightBound=' + rightBound }

    return fetch('../api/unpaidReasons.php?token=' + getCookie("cnxToken") + left + right + nS + rS, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

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

function getTreasury() {
    console.log("Fetching via getTreasury()");

    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }
    let order = (document.getElementById("order-by") && document.getElementById("order-by").value != "") ? '&orderby=' + document.getElementById("order-by").value : "";
    
    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value != "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";

    return fetch('../api/treasuryForEach.php?token=' + getCookie("cnxToken") + nS + order, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

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

function getTreasuryPerMonth(leftBound, rightBound) {
    console.log("Fetching via getTreasuryPerMonth()");

    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }

    let left = "";
    let right = "";

    let nS = (document.getElementById("nSIREN") && document.getElementById("nSIREN").value != "") ? '&nSIREN=' + document.getElementById("nSIREN").value : "";

    if (leftBound !== "") { left = '&leftBound=' + leftBound }

    if (rightBound !== "") { right = '&rightBound=' + rightBound }
    console.log('../api/treasuryPerMonth.php?token=' + getCookie("cnxToken") + left + right + nS);
    return fetch('../api/treasuryPerMonth.php?token=' + getCookie("cnxToken") + left + right + nS, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

        .then(response => response.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
        });
}

function getDiscount() {
    console.log("Fetching via getDiscount()");
    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }
    let nR = (document.getElementById("nRemise") && document.getElementById("nRemise").value != "") ? '&nRemise=' + document.getElementById("nRemise").value : "";

    return fetch('../api/discountForEach.php?token=' + getCookie("cnxToken") + nR, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

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

function getDiscountDetails(nRemise) {
    console.log("Fetching via getDiscountDetails()");
    if (getCookie("cnxToken") === null) {
        document.location.href = "../index.html";
    }
    let nR = "";
    if (nRemise !== null) {
        nR = '&nRemise=' + nRemise;
    }
    return fetch('../api/discountDetails.php?token=' + getCookie("cnxToken") + nR, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })

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

export { getUnpaidsForEach, getUnpaidsPerMonth, getUnpaidReasons, getTreasury, getTreasuryPerMonth, getDiscount, getDiscountDetails };