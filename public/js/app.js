import "./bootstrap";

import { flashMessage } from "./components/FlashMessage";
import {SearchFilter} from "./scripts/SearchFilter";

const webComponents = [ flashMessage ]
const scripts = [ SearchFilter ]
const registerWebComponents = () => { webComponents.forEach((component) => { component() }) }
const registerScripts = () => { scripts.forEach((script) => { new script() }) }

const installPWA = () => {
    if('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
            .then(() => console.log('Service Worker Registered'))
    } else {
        console.log('Service Worker not supported')
    }
}

window.onload = () => {
    installPWA()
    registerWebComponents();
    registerScripts();
}
