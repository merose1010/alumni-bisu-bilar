

const data = {
    labels: day_labels,
    datasets: [{
      label: 'Daily Sales (PHP)',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: day_data, // Note: use the {!! !!} syntax to output the data as-is
    }]
  };
  
  const config_line = {
    type: 'line',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      title: {
        display: true,
        text: 'Monthly Sales'
      },
      // Set the chart width and height here
      width: 800,
      height: 400
    }
  };
  
  
  const config_bar = {
    type: 'bar',
    data: data,
    options: {
      animations: {
        tension: {
          duration: 1000,
          easing: 'linear',
          from: 1,
          to: 0,
          loop: true
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      },
      title: {
        display: true,
        text: 'Monthly Sales'
      },
    }
  };
  
  
  let myChart = new Chart(
    document.getElementById('alumni_mem_Chart'),
    config_bar
  );
  
  document.getElementById('display-selector').addEventListener('change', function() {
    var displayType = this.value;
    var labels, data, title, datasetLabel;
    
    if (displayType === 'day') {
      labels = day_labels;
      data = day_data;
      title = 'Daily Sales';
      datasetLabel = 'Daily Sales';
    } else if (displayType === 'week') {
      labels = week_labels;
      data = week_data;
      title = 'Weekly Sales';
      datasetLabel = 'Weekly Sales';
    } else if (displayType === 'month') {
      labels = month_labels;
      data = month_data;
      title = 'Monthly Sales';
      datasetLabel = 'Monthly Sales';
    } else if (displayType === 'year') {
      labels = year_labels;
      data = year_data;
      title = 'Yearly Sales';
      datasetLabel = 'Yearly Sales';
    }
    
    myChart.data.labels = labels;
    myChart.data.datasets[0].label = datasetLabel;
    myChart.data.datasets[0].data = data;
    myChart.options.title.text = title;
  
    myChart.update();
  });
  
  function memChart(type){
    myChart.destroy();
    if (type === 'bar') {
        myChart = new Chart(
        document.getElementById('alumni_mem_Chart'),
        config_bar
      );
    }
  
    if (type === 'line') {
      myChart = new Chart(
      document.getElementById('alumni_mem_Chart'),
      config_line
    );
  }
  }
  
  