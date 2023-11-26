function getCookie(name) {
    let cookieArr = document.cookie.split("; ");
    for(let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if(name == cookiePair[0]) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}
  

function getUnpaidsPerMonth(leftBound, rightBound) {
    console.log("Fetching via getUnpaidsPerMonth()");

    if (getCookie("cnxToken") === null){
        document.location.href = "../index.html";
    }

    let left="";
    let right="";

    if (leftBound !== ""){ left = '&leftBound='+leftBound }

    if (rightBound !== "" ){ right = '&rightBound='+rightBound }

    return fetch('../api/unpaidsPerMonth.php?token='+getCookie("cnxToken")+left+right, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    
        .then(response => response.json())
        .then(data => { console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
        });
    }

function getUnpaidsForEach(leftBound, rightBound, orderby, nImpaye){
    console.log("Fetching via getUnpaidsForEach()");

    if (getCookie("cnxToken") === null){
        document.location.href = "../index.html";
    }

    let left="";
    let right="";
    let order="";
    let nImp="";

    if (leftBound !== ""){ left = '&leftBound='+leftBound }

    if (rightBound !== "" ){ right = '&rightBound='+rightBound }

    if (orderby !== "" ){ order = '&orderby='+orderby }

    if (nImpaye !== "" ){ nImp = '&nImp='+nImpaye }

    return fetch('../api/unpaidsForEach.php?token='+getCookie("cnxToken")+left+right+order+nImp, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    
        .then(response => response.json())
        .then(data => { console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
        });
}

function getUnpaidReasons(leftBound, rightBound) {
    console.log("Fetching via getUnpaidsPerMonth()");

    if (getCookie("cnxToken") === null){
        document.location.href = "../index.html";
    }

    let left="";
    let right="";

    if (leftBound !== ""){ left = '&leftBound='+leftBound }

    if (rightBound !== "" ){ right = '&rightBound='+rightBound }

    return fetch('../api/unpaidReasons.php?token='+getCookie("cnxToken")+left+right, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    
        .then(response => response.json())
        .then(data => { console.log(data);
            return data;
        })
        .catch(error => {
            console.error(error);
            console.log(data);
        });
    }

export {getUnpaidsForEach, getUnpaidsPerMonth, getUnpaidReasons};