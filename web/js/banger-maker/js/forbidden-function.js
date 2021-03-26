/**
 *
 * @param tag String
 * @param parent HTMLElements
 * @param text String
 * @param id String
 * @param classes String
 * @param randPropeties
 * @returns {*}
 * @private
 */
export function _(tag, parent,{ text=null,  id=null, classes=null, ...randPropeties}={}) {
    let element = document.createElement(tag);
    if (text)
        element.appendChild(document.createTextNode(text));
    parent.appendChild(element);
    if (id)
        element.id = id;

    if (classes != null) {
        var classesArray = classes.split(" ");
        if (classes != null)
            for (let clas in classesArray)
                element.classList.add(classesArray[clas]);
    }

    Object.entries( randPropeties ).forEach(([key,value])=>element.setAttribute(key,value));
    return element;
}

