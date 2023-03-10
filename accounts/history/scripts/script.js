
function StopLoadingSpinner() {
    
    const spinner = document.querySelector("div#loading-spinner");

    console.log(spinner);
    spinner.style.opacity = 0;
    const transEvent = WhichTransitionEvent();
    spinner.addEventListener(transEvent, function () {
        spinner.style.display = "none";
    });

}

function WhichTransitionEvent(){
    var t;
    var el = document.createElement('fakeelement');
    var transitions = {
      'transition':'transitionend',
      'OTransition':'oTransitionEnd',
      'MozTransition':'transitionend',
      'WebkitTransition':'webkitTransitionEnd'
    }

    for(t in transitions){
        if( el.style[t] !== undefined ){
            return transitions[t];
        }
    }
}