

const aid_data = {
    labels: aid_day_labels,
    datasets: [{
      label: 'Daily Sales (PHP)',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: aid_day_data, // Note: use the {!! !!} syntax to output the data as-is
    }]
  };
  
  const aid_config_line = {
    type: 'line',
    data: aid_data,
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
  
  
  const aid_config_bar = {
    type: 'bar',
    data: aid_data,
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
  
  
  let myAidChart = new Chart(
    document.getElementById('alumni_id_Chart'),
    aid_config_bar
  );
  
  document.getElementById('aid_display-selector').addEventListener('change', function() {
    var displayType = this.value;
    var labels, data, title, datasetLabel;
    
    if (displayType === 'day') {
      labels = aid_day_labels;
      data = aid_day_data;
      title = 'Daily Sales';
      datasetLabel = 'Daily Sales';
    } else if (displayType === 'week') {
      labels = aid_week_labels;
      data = aid_week_data;
      title = 'Weekly Sales';
      datasetLabel = 'Weekly Sales';
    } else if (displayType === 'month') {
      labels = aid_month_labels;
      data = aid_month_data;
      title = 'Monthly Sales';
      datasetLabel = 'Monthly Sales';
    } else if (displayType === 'year') {
      labels = aid_year_labels;
      data = aid_year_data;
      title = 'Yearly Sales';
      datasetLabel = 'Yearly Sales';
    }
    
    myAidChart.data.labels = labels;
    myAidChart.data.datasets[0].label = datasetLabel;
    myAidChart.data.datasets[0].data = data;
    myAidChart.options.title.text = title;
  
    myAidChart.update();
  });
  
  function IDchart(type){
    myAidChart.destroy();
    if (type === 'bar') {
        myAidChart = new Chart(
        document.getElementById('alumni_id_Chart'),
        aid_config_bar
      );
    }
  
    if (type === 'line') {
      myAidChart = new Chart(
      document.getElementById('alumni_id_Chart'),
      aid_config_line
    );
  }
  }
  
  