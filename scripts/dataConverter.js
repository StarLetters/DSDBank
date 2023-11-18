function convertToCumulativeBalance(data, startDate, endDate){

    if (startDate === ""){
        startDate = new Date(data[0].dateVente);
    }
    if (endDate === ""){
        endDate = new Date(data[data.length-1].dateVente);
    }


    let cumulativeBalance = 0;
    let index = 0;
    const cumulativeBalanceArray = [];

    while (startDate < endDate){

        if (startDate === data[index].dateVente ){
            cumulativeBalance += parseFloat(data[index].montant);
            cumulativeBalanceArray.push(cumulativeBalance);
            index++;
        }

        startDate.setDate(startDate.getDate() + 1);
    }
    console.log(cumulativeBalanceArray);
    return cumulativeBalanceArray;
}



const ye = [
    {montant : "500.00", dateVente : "2021-01-01"},
    {montant : "500.00", dateVente : "2021-01-02"},
    {montant : "500.00", dateVente : "2021-01-03"},
    {montant : "500.00", dateVente : "2021-01-04"},
    {montant : "500.00", dateVente : "2021-01-10"},

]

const test = convertToCumulativeBalance(ye, "2021-01-01", "2021-01-10");

export {convertToCumulativeBalance};