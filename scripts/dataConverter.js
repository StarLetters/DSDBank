
// Fonction qui convertit les impayés en données cumulatives ex : [50, 50, 50, 150]
// Les trois premiers jours la somme est de 50€, le quatrième jour la somme est de 150€ vu qu'une transaction de 100€ a été effectuée
// Au lieu de faire une array de n cases, on retourne un objet avec les sommes cumulées comme clés et le nombre de fois qu'elles apparaissent comme valeurs
// ex Object { 250: 56, 8750: 71, 8900: 56, 13400: 43, 31900: 21, 33400: 19, 41000: 196, 49200: 20 }
// Plutôt que Array(482) [ 250, 250, 250, 250, 250, 250, 250, 250, 250, 250, … ]

function convertToCumulativeBalance(dataPromise, start, end){
    return dataPromise.then(data => {

        if (start === ""){
            startDate = new Date(data[0].dateVente);
        } else {
            startDate = new Date(start);
        }

        if (end === ""){
            endDate = new Date(data[data.length-1].dateVente);
        } else { 
            endDate = new Date(end);
        }

        const differenceEnMillisecondes = Math.abs(endDate.getTime() - startDate.getTime());
        const differenceEnJours = Math.ceil(differenceEnMillisecondes / (1000 * 60 * 60 * 24));

        let cumulativeBalance = 0;
        const cumulativeBalanceC = {};

        let j=0;
        
        for (let i = 0; i < differenceEnJours; i++){

            const currentDate = new Date(startDate);
            currentDate.setDate(currentDate.getDate() + i);
            
          
            if ( currentDate.toISOString().split('T')[0]  === data[j].dateVente ){
                cumulativeBalance += parseFloat(data[j].montant);
                cumulativeBalanceC[cumulativeBalance] = 0;
                j++;
            }
            cumulativeBalanceC[cumulativeBalance]++;
            
        }

        
        console.log("Résultat",cumulativeBalanceC); //TODO : optimiser le load de la page
        return {cumulativeBalanceC, startDate, endDate};
    });
}

export {convertToCumulativeBalance};