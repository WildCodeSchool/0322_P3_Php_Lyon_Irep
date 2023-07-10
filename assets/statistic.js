import { Chart } from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    let homepageChart = document.getElementById('homepageChart');
    let galleryChart = document.getElementById('galleryChart');
    let pictureViewsChart = document.getElementById('pictureViewsChart');

    let homepageData = JSON.parse(homepageChart.dataset.chart);
    homepageData.forEach(data => {
        data.date = data.date.split(" ")[0];
    });

    let galleryData = JSON.parse(galleryChart.dataset.chart);
    galleryData.forEach(data => {
        data.date = data.date.split(" ")[0];
    });

    let pictureViewsData = JSON.parse(pictureViewsChart.dataset.chart);

    let pictureViewsCounts = Object.entries(pictureViewsData).map(([, value]) => {
        if (Array.isArray(value) && value.length > 0) {
            return value.reduce((acc, curr) => acc + Number(curr.count), 0);
        } else {
            return 0;
        }
    });

    let pictureLabels = Object.keys(pictureViewsData).map(key => {
        let title = key.substring(0, 10);
        return title.length < key.length ? title + "..." : title;
    });

    new Chart(homepageChart.getContext('2d'), {
        type: 'line',
        data: {
            labels: homepageData.map(data => data.date),
            datasets: [{
                label: 'Visites de la page d’accueil',
                data: homepageData.map(data => Number(data.count)),
                backgroundColor: '#EAD07F',
                fill: false,
                borderColor: '#EAD07F',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
        }
    });

    new Chart(galleryChart.getContext('2d'), {
        type: 'line',
        data: {
            labels: galleryData.map(data => data.date),
            datasets: [{
                label: 'Visites de la galerie',
                data: galleryData.map(data => Number(data.count)),
                backgroundColor: '#EAD07F',
                fill: false,
                borderColor: '#EAD07F',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
        }
    });

    new Chart(pictureViewsChart.getContext('2d'), {
        type: 'bar',
        data: {
            labels: pictureLabels,
            datasets: [{
                label: 'Visites par oeuvre',
                data: pictureViewsCounts,
                backgroundColor: '#EAD07F',
                borderColor: '#EAD07F',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

document.getElementById('exhibitionSelect').addEventListener('change', function() {
    window.location.href = this.value;
});