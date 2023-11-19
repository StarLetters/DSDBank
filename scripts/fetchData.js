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
  



function getUnpaid(leftBound, rightBound) {
    console.log("Fetching via getUnpaid()");

    if (getCookie("cnxToken") === null){
        document.location.href = "../index.html";
    }

    let left="";
    let right="";

    if (leftBound !== ""){ left = '&leftBound='+leftBound }

    if (rightBound !== "" ){ right = '&rightBound='+rightBound }

    return fetch('../api/unpaid.php?id='+getCookie("cnxToken")+left+right, {
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




export {getUnpaid};