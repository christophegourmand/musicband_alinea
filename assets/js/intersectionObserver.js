// ############################################################
// ################  EFFECT ON  APPEAR ########################
// ############################################################

/**
* when HTMLElement appears with a coefficient of visibility (param2), will apply callback (param1) 
* @param {callback} onAppear_func - function to apply, will receive 1:HTML_DOM_Element, 2:entries
* @param {number} coeffOfVisibility_float - a value from 0.0 to 1.0 (optionnal, set to 1 if not given)
* @author Christophe GOURMAND
*/
HTMLElement.prototype.effectOnAppear = function(onAppear_func, coeffOfVisibility_float = 1.0){
    // save html target element (as this will change in nested-following-functions) 
    targetNode = this;
    
    // prepare options for visibility-observer
    var optionsForVisibilityObserver = 
    {
        // define 'root' which is the parent node element who contain the <elements to check visibility>
        root: null, // use `null` if you want the display (viewport) itself.
        rootMargin: '0px',
        threshold: coeffOfVisibility_float // coefficient of visibility required to start the callback
    };

    // create callback for visibility-observer = what actions to perform
    function callbackForVisibilityObserver (entries_received, observer_received) {
        entries_received.forEach(
            entry => {
                // console.debug(entry.intersectionRatio); // 🛑 DEBUG
                if (entry.isIntersecting) {
                    //console.debug(entry); // 🛑 DEBUG
                    //console.info("👀 the node is intersecting"); // 🛑 DEBUG
                    onAppear_func(targetNode, entry); // will receive the HTML_DOM_Element + entries
                }
            }
        );
    }

    // create visibility-observer
    var visibilityObserver = new IntersectionObserver(
        callbackForVisibilityObserver, 
        optionsForVisibilityObserver // will receive 'p1:entries' when change occup + 'p2:observer'
    );

    visibilityObserver.observe(targetNode);
}

// ############################################################
// ################  EFFECT ON  DISAPPEAR #####################
// ############################################################

/**
* when HTMLElement disappears with a coefficient of visibility (param2), will apply callback (param1) 
* @param {callback} onAppear_func - function to apply, will receive 1:HTML_DOM_Element, 2:entries
* @param {number} coeffOfVisibility_float - a value from 0.0 to 1.0 (optionnal, set to 1 if not given)
* @author Christophe GOURMAND
*/
HTMLElement.prototype.effectOnDisappear = function(onDisappear_func, coeffOfVisibility_float = 1.0){
    // save html target element (as this will change in nested-following-functions) 
    targetNode = this;
    
    // prepare options for visibility-observer
    var optionsForVisibilityObserver = 
    {
        // define 'root' which is the parent node element who contain the <elements to check visibility>
        root: null, // use `null` if you want the display (viewport) itself.
        rootMargin: '0px',
        threshold: coeffOfVisibility_float // coefficient of visibility required to start the callback
    };

    // create callback for visibility-observer = what actions to perform
    function callbackForVisibilityObserver (entries_received, observer_received) {
        entries_received.forEach(
            entry => {
                if (typeof coeffOfVisibility_float === 'number') {
                    // console.debug(entry.intersectionRatio); // 🛑 DEBUG
                    if (!entry.isIntersecting) {
                        onDisappear_func(targetNode, entry); // will receive the HTML_DOM_Element + entries
                    }
                }
            }
        );
    }

    // create visibility-observer
    var visibilityObserver = new IntersectionObserver(
        callbackForVisibilityObserver, 
        optionsForVisibilityObserver // will receive 'p1:entries' when change occup + 'p2:observer'
    );

    visibilityObserver.observe(targetNode);
}

// ############################################################
// ################  EFFECT ON APPEAR PER STEPS ###############
// ############################################################

/**
* when HTMLElement appears with a coefficient of visibility (param2), will apply callback (param1) 
* @param {callback} onAppear_func - function to apply, will receive 1:HTML_DOM_Element, 2:entries
* @param {object} coeffOfVisibility_float - an array of values from 0.0 to 1.0 (optionnal, set to [.25, .5, .75, 1.0] if not given)
* @author Christophe GOURMAND
*/
HTMLElement.prototype.effectOnAppearPerSteps = function(onAppearPerSteps_func, coeffOfVisibility_arr = [.25, .5, .75, 1.0]){
    // save html target element (as this will change in nested-following-functions) 
    targetNode = this;
    
    // prepare options for visibility-observer
    var optionsForVisibilityObserver = 
    {
        // define 'root' which is the parent node element who contain the <elements to check visibility>
        root: null, // use `null` if you want the display (viewport) itself.
        rootMargin: '0px',
        threshold: coeffOfVisibility_arr // coefficient of visibility required to start the callback
    };

    // create callback for visibility-observer = what actions to perform
    function callbackForVisibilityObserver (entries_received, observer_received) {
        entries_received.forEach(
            entry => {
                if (Array.isArray(coeffOfVisibility_arr)) {
                    onAppearPerSteps_func(targetNode, entry); // will receive the HTML_DOM_Element + entries
                }
            }
        );
    }

    // create visibility-observer
    var visibilityObserver = new IntersectionObserver(
        callbackForVisibilityObserver, 
        optionsForVisibilityObserver // will receive 'p1:entries' when change occup + 'p2:observer'
    );

    visibilityObserver.observe(targetNode);
}