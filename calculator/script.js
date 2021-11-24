
function clarData() {
    document.getElementById("result").value = "";
}

function myMathLine(value) {
    document.getElementById("result").value += value;
}

function calculate() {
    var myMath = document.getElementById("result").value;
    var res = eval(myMath);
    document.getElementById("result").value = res;
}