const labels2 = ["Photo" , "Sheets" , "Documents"];

const data2 = {
  labels: labels2,
  datasets: [
    {
      label: 'Data',
      data: [10, 108, 206],
      backgroundColor: 'rgb(250, 199, 132)',
      borderColor: 'rgb(250, 199, 132)',
      borderWidth: 2,
      borderRadius: 8,
      borderSkipped: false,
    }
  ]
};

const config2 = {
  type: 'bar',
  data: data2,
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false
      },
      title: {
        display: true,
        text: 'Files'
      }
    }
  },
};

  
  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );
