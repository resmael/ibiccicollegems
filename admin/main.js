const chartData = {
  // List item
  labels: ["Actual", "Variance"],
  // Percentage per item
  data: [89.45, 10.55],
};

const myChart = document.querySelector(".donut-chart");
// Calling item List in javascript Without typing on HTML List
const ul = document.querySelector(".programming-stats .details ul");
// Calling item List in javascript Without typing on HTML List identity END

new Chart(myChart, {
  // Donut Chart ("doughnut")
  type: "doughnut",
  // Donut Chart ("doughnut") identity END
  data: {
    labels: chartData.labels,
    datasets: [
      {
        // Labels inside the donut graph
        labels: "Language Popularity",
        // Labels inside the donut graph identity END
        data: chartData.data,
      },
    ],
  },
  options: {
    // Width Graph
    borderWidth: 5,
    // Radius Graph
    // borderRadius: 20,
    hoverBorderWidth: 0,
    plugins: {
      legend: {
        display: false,
      },
    },
  },
});

/* Source Code to Display item List */
const populateUl = () => {
  chartData.labels.forEach((l, i) => {
    let li = document.createElement("li");
    li.innerHTML = `${l}: <span class="percentage">${chartData.data[i]}%</span>`;
    ul.appendChild(li);
  });
};

populateUl();

let labels = [
  "",
  "JAN",
  "FEB",
  "MAR",
  "APR",
  "MAY",
  "JUN",
  "JUL",
  "AUG",
  "SEP",
  "OCT",
  "NOV",
  "DEC",
];

// BASILAN DATA CHART
let BasilanActual = [
  "",
  "5",
  "15",
  "30",
  "35",
  "45",
  "65",
  "75",
  "80",
  "85",
  "25",
  "45",
  "90",
];

let BasilanPlan = [
  "",
  "11",
  "15",
  "20",
  "25",
  "30",
  "35",
  "40",
  "45",
  "50",
  "55",
  "90",
  "100",
];

let BasilanVariance = [
  "",
  "-5",
  "-10",
  "-8",
  "-7",
  "-4",
  "-14",
  "-5",
  "-6",
  "-8",
  "-13",
  "-17",
  "-20",
];
// SULU END DATA CHART

const basilan = {
  labels: labels,
  datasets: [
    {
      data: BasilanActual,
      /* Color data line */
      borderColor: "rgb(52, 235, 131)",
      /* Curve tension line */
      tension: 0.5,
    },
    {
      data: BasilanPlan,
      /* Color data line */
      borderColor: "rgb(66, 156, 245)",
      /* Curve tension line */
      tension: 0.5,
    },
    {
      data: BasilanVariance,
      /* Color data line */
      borderColor: "rgb(230, 245, 66)",
      /* Curve tension line */
      tension: 0.5,
    },
  ],
};

const basilanconfig = {
  type: "line",
  data: basilan,
  options: {
    aspectRatio: 2.9,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "by Month",
      },
    },
  },
};

const basilanchart = new Chart(
  document.getElementById("basilan-chart"),
  basilanconfig
);
