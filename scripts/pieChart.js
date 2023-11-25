const makePieChart = (fetchedData, labels, colors) => {
  const data = {
    labels: labels,
    datasets: [
      {
        label: "My First Dataset",
        data: fetchedData,
        backgroundColor: colors,
        hoverOffset: 4,
      },
    ],
  };

  const ctx = document.getElementById("pieChart").getContext("2d");
  new Chart(ctx, {
    type: "pie",
    data: data,
    options: {
      plugins: {
        legend: {
          position: "bottom",
        },
      },
    },
  });
};






export { makePieChart };
