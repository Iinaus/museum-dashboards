function fetchData() {
  google.charts.load("current", { packages: ["corechart", "bar"] }); // ladataan tarvittavien graafien paketit
  fetch("user_data_tickets_month.php") // haetaan tiedot tickets by month graafia varten
    .then((response) => response.json())
    .then((data) => {
      // luodaan array graafin piirtoa varten, jossa jokainen rivi on oma arrayrivi
      let ticketsByMonth = [["Month", "Tickets"]];
      data.forEach((row) => {
        const arrayRow = [row.month, row.tickets];
        ticketsByMonth.push(arrayRow);
      });

      // tarkistetaan onko dataa, jos on niin kutsutaan piirtofunktiota, jos ei niin annetaan siitä ilmoitus
      if (ticketsByMonth.length > 1) {
        google.charts.setOnLoadCallback(drawTicketsByMonth);
      } else {
        document.getElementById("ticketsByMonth").innerHTML =
          "No data available.";
      }

      // piirretään graafi
      function drawTicketsByMonth() {
        var data = google.visualization.arrayToDataTable(ticketsByMonth);

        var options = {
          title: "Tickets sold by month",
          legend: "none",
          colors: ["#a73b8f"],
          isStacked: true,
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("ticketsByMonth")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  fetch("user_data_tickets_year.php")
    .then((response) => response.json())
    .then((data) => {
      let ticketsByYear = [["Year", "Tickets"]];
      data.forEach((row) => {
        const arrayRow = [row.year, row.tickets];
        ticketsByYear.push(arrayRow);
      });

      if (ticketsByYear.length > 1) {
        google.charts.setOnLoadCallback(drawTicketsByYear);
      } else {
        document.getElementById("ticketsByYear").innerHTML =
          "No data available.";
      }

      function drawTicketsByYear() {
        var data = google.visualization.arrayToDataTable(ticketsByYear);

        var options = {
          title: "Tickets sold by year",
          legend: "none",
          colors: ["#a73b8f"],
          isStacked: true,
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("ticketsByYear")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  fetch("user_data_visitortype.php")
    .then((response) => response.json())
    .then((data) => {
      let visitors = [["Month", "Not member", "Member"]];
      data.forEach((row) => {
        const arrayRow = [row.month, row.notmember, row.member];
        visitors.push(arrayRow);
      });

      if (visitors.length > 1) {
        google.charts.setOnLoadCallback(drawVisitors);
      } else {
        document.getElementById("visitorType").innerHTML = "No data available.";
      }

      function drawVisitors() {
        var data = google.visualization.arrayToDataTable(visitors);

        var options = {
          title: "Visitor types by month",
          colors: ["#a73b8f", "#ee8695"],
          isStacked: true,
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("visitorType")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  fetch("user_data_ticket_types.php")
    .then((response) => response.json())
    .then((data) => {
      let ticketType = [["Month", "Normal", "Discount", "Children"]];
      data.forEach((row) => {
        const arrayRow = [
          row.month,
          row.normtickets,
          row.disctickets,
          row.chiltickets,
        ];
        ticketType.push(arrayRow);
      });

      if (ticketType.length > 1) {
        google.charts.setOnLoadCallback(drawTicketType);
      } else {
        document.getElementById("ticketType").innerHTML = "No data available.";
      }

      function drawTicketType() {
        var data = google.visualization.arrayToDataTable(ticketType);

        var options = {
          title: "Ticket type percentages by month",
          colors: ["#502063", "#7b2a95", "#d54d88"],
          isStacked: "percent",
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("ticketType")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  fetch("user_data_visiting_times.php")
    .then((response) => response.json())
    .then((data) => {
      let visitingTimes = [["Hour", "Visitors"]];
      data.forEach((row) => {
        const arrayRow = [row.time, row.tickets];
        visitingTimes.push(arrayRow);
      });

      if (visitingTimes.length > 1) {
        google.charts.setOnLoadCallback(drawVisitingTimes);
      } else {
        document.getElementById("visitingTimes").innerHTML =
          "No data available.";
      }

      function drawVisitingTimes() {
        var data = google.visualization.arrayToDataTable(visitingTimes);

        var options = {
          title: "Visiting times",
          legend: "none",
          colors: ["#a73b8f"],
          isStacked: true,
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("visitingTimes")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  fetch("user_data_paymentmethods.php")
    .then((response) => response.json())
    .then((data) => {
      let payment = [["Month", "Debit", "Cash"]];
      data.forEach((row) => {
        const arrayRow = [row.month, row.debit, row.cash];
        payment.push(arrayRow);
      });

      if (payment.length > 1) {
        google.charts.setOnLoadCallback(drawPayment);
      } else {
        document.getElementById("paymentMethods").innerHTML =
          "No data available.";
      }

      function drawPayment() {
        var data = google.visualization.arrayToDataTable(payment);

        var options = {
          title: "Payment methods by month",
          colors: ["#a73b8f", "#ee8695"],
          isStacked: true,
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("paymentMethods")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  fetch("user_data_employees.php")
    .then((response) => response.json())
    .then((data) => {
      let employees = [
        [
          "Month",
          "Eid1 tickets",
          "Eid2 tickets",
          "Eid3 tickets",
          "Eid4 tickets",
          "Eid5 tickets",
          "Eid6 tickets",
          "Eid7 tickets",
        ],
      ];
      data.forEach((row) => {
        const arrayRow = [
          row.month,
          row.eid1_tickets,
          row.eid2_tickets,
          row.eid3_tickets,
          row.eid4_tickets,
          row.eid5_tickets,
          row.eid6_tickets,
          row.eid7_tickets,
        ];
        employees.push(arrayRow);
      });

      if (employees.length > 1) {
        google.charts.setOnLoadCallback(drawEmployees);
      } else {
        document.getElementById("ticketsByEmployees").innerHTML =
          "No data available.";
      }

      function drawEmployees() {
        var data = google.visualization.arrayToDataTable(employees);

        var options = {
          title: "Tickets sold by month",
          colors: [
            "#37114e",
            "#511b75",
            "#6f2597",
            "#a73b8f",
            "#e05286",
            "#ed8495",
            "#f7bba6",
          ],
          height: 250,
          isStacked: true,
          chartArea: { width: "70%" }, //Muuttaa chartin kokoa niin jää legendille enemmän tilaa
        };

        var chart = new google.visualization.ColumnChart(
          document.getElementById("ticketsByEmployees")
        );

        chart.draw(data, options);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  fetchData();
});

//Kuuntelee, jos logout nappia painetaan ja suoritetaan logout.php joka lopettaa session
document.getElementById("logOutButton").addEventListener("click", function () {
  window.location.href = "../logout.php";
});
