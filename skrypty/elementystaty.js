document.getElementById('statistic').addEventListener('change', function () {
    var selectedValue = this.value;
    if (selectedValue === 'dailySales' || selectedValue === 'dailySizeSales') {
        document.getElementById('dateInput').style.display = 'block';
        document.getElementById('monthInput').style.display = 'none';
    } else if (selectedValue === 'monthlySales' || selectedValue === 'monthlySizeSales' || selectedValue === 'topPizza') {
        document.getElementById('dateInput').style.display = 'none';
        document.getElementById('monthInput').style.display = 'block';
    } else {
        document.getElementById('dateInput').style.display = 'none';
        document.getElementById('monthInput').style.display = 'none';
    }
});