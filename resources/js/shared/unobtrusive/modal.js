var nextModalId = function (container) {
    const id = (+container.getAttribute("modals-count")) + 1;
    container.setAttribute("modals-count", id);
    return `policy-ui-modal_${id}`;
}

var createModalImpl = function (modal_content, container, modalId = null, appendAsNode = false) {
    const modal = document.createElement("div");
    const id = modalId ?? nextModalId(container);
    modal.id = id;
    modal.className = "modal modal-container";

    if (appendAsNode) {
        modal.appendChild(modal_content);
        container.appendChild(modal);
    } else {
        modal.innerHTML = modal_content;
        container.append(modal);
    }

    // Alpine.discoverUninitializedComponents((el) => {
    //     Alpine.initializeComponent(el)
    // }, container)

    return id;
};

var closeModalImpl = function (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.remove();
    }
};

(function init() {
    const modals = document.createElement("div");
    modals.id = "policy-ui-modals-container";
    document.body.append(modals);

    document.addEventListener("click", (e) => {
        let el = e.target, found;
        while (el && !(found = el.matches("[data-remote][data-modal]"))) {
            el = el.parentElement;
        }
        if (found) {
            e.preventDefault();

            let link_href = el.href;
            if (link_href == null) {
                let formData = new FormData(el);
                let search = new URLSearchParams(formData);

                link_href = `${el.action}?${search.toString()}`;
                console.log(link_href, el, formData, search);
            }
            if (link_href.indexOf("?") == -1) {
                link_href += "?modal=true";
            } else {
                link_href += "&modal=true";
            }

            fetch(link_href)
                .then(response => response.text())
                .then(html => createModalImpl(html, modals));

            return false;
        }
    })

    document.addEventListener("click", (e) => {
        let el = e.target, found;
        while (el && !(found = el.matches("[data-cancel]"))) {
            el = el.parentElement;
        }
        if (found) {
            e.preventDefault();

            while (el && !(found = el.matches(".modal-container"))) {
                el = el.parentElement;
            }

            if (found) {
                console.log(el);
                closeModalImpl(el.id);
            }

            return false;
        }
    })

})();

export { createModalImpl as createModal, closeModalImpl as closeModal, nextModalId };
