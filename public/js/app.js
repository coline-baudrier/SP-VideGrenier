import "./bootstrap";

import { flashMessage } from "./components/FlashMessage";
import { ArroundMeFilter } from "./scripts/ArroundMeFilter";
import { CustomSelect } from "./scripts/TomSelect";
import {FeaturedFilter} from "./scripts/FeaturedFilter";
import {SearchFilter} from "./scripts/SearchFilter";

const webComponents = [ flashMessage ]
const scripts = [ ArroundMeFilter, FeaturedFilter, CustomSelect, SearchFilter ]
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
