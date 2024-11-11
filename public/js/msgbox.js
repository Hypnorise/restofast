function Msgbox() {
    const _markup = `
    <div class="__xq_msgbox">
\t<div class="__msgbox_window">
\t\t<div class="__msgbox_header">
\t\t\t<span class="__msgbox_title">Titre</span>
\t\t\t<button class="btn-close">&times;</button>
\t\t</div>
\t\t<div class="__msgbox_body">
\t\t\t<div class="__msgbox_content">
\t\t\t\tLorem ipsum dolor sit amet, consectetur adipisicing elit. Animi asperiores, consequatur cupiditate dolor
\t\t\t\terror nam non praesentium sapiente tempore veritatis. Doloribus ducimus ea est incidunt, quia quisquam
\t\t\t\trepudiandae tenetur velit!
\t\t\t</div>
\t\t</div>
\t\t<div class="__msgbox_footer">
\t\t</div>
\t</div>
</div>
    `;
    const template = document.createElement("template");
    let elem;
    let resolver;
    this.buttons = {
        btnOk: 1, btnCancel: 3, btnYes: 5, btnNo: 7
    }
    template.innerHTML = _markup;

    /**
     * Opens the Message Box
     * @param {Array|Object} btns
     * @param {String} title
     * @param {String} content
     */
    this.open = async function (btns = 0, title = "Message", content = "") {
        template.innerHTML = _markup;
        document.body.appendChild(template.content);
        elem = document.querySelector(".__xq_msgbox");
        if (Array.isArray(btns)) {
            for (let btnId of btns) {
                let btn = createButton(btnId);
                elem.querySelector(".__msgbox_footer").appendChild(btn);
            }
        } else if (btns.constructor.name === "Object") {
            for (let [key,text] of Object.entries(btns)) {
                let btn = createButton(this.buttons[key],text);
                elem.querySelector(".__msgbox_footer").appendChild(btn);
            }
        }
        elem.querySelector(".__msgbox_header span").innerHTML = title;
        elem.querySelector(".__msgbox_content").innerHTML = content;
        elem.querySelector(".__msgbox_footer button").setDefault();

        elem.querySelector(".btn-close").addEventListener("click",()=>{  resolver(null) })
        let closers = elem.querySelectorAll(".btn-close,.__msgbox_footer button");
        for (let closer of closers) closer.addEventListener("click", () => { this.close() });
        return await new Promise(resolve => {
            resolver = resolve
        })
    }
    this.close = function () {
        elem.addEventListener("animationend", () => { document.body.removeChild(elem) })
        elem.classList.add("__xq_msgbox_close");
    }

    function createButton(id, text) {
        let btn;
        id = parseInt(id)
        btn = document.createElement("button");
        btn.setDefault = function () {
            this.classList.add("default")
        }
        switch (id) {
            case 1:
                btn.classList.add(".btnOk");
                btn.innerHTML = text || "Ok";
                break;
            case 3:
                btn.classList.add(".btnCancel");
                btn.innerHTML = text || "Annuler";
                break;
            case 5:
                btn.classList.add(".btnYes");
                btn.innerHTML = text || "Oui";
                break;
            case 7:
                btn.classList.add(".btnNo");
                btn.innerHTML = text || "Non";
                break;
        }
        btn.addEventListener("click",()=>{  resolver(id) })
        return btn
    }
}
