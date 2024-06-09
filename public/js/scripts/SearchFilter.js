import axios from 'axios';

console.log("SearchFilter.js loaded"); //pour vérifier que le script est bien chargé dans la page
export class SearchFilter {
    constructor() {
        console.log("SearchFilter initialized"); //pour vérifier l'initialisation du script
        this.searchBarFilter = document.querySelector("#search-input");
        if (!this.searchBarFilter) { return; }
        this.inputField = this.searchBarFilter.querySelector("input");
        this.inputField.addEventListener("keyup", () => { this.filter() });
        this.inputField.addEventListener("change", () => { this.filter() });
        this.inputField.addEventListener("keydown", () => { this.filter() });
    }

    async filter() {
        let val = this.inputField.value;
        if (this.inputField.value.length <= 3) { val = "all"; }

        console.log("Searching for:", val); // Log de la valeur recherchée

        try {
            const response = await axios({
                method: "GET",
                url: `/api/product/search?search=${val}`,
            });
            console.log("Response from API:", response.data); // Log de la réponse de l'API
            this.emptyProducts();
            this.displayProducts(response.data);
        } catch (error) {
            console.error("Error during filtering:", error);
        }
    }

    emptyProducts() {
        const container = document.querySelector("#articlelist");
        container.innerHTML = "";
    }

    displayProducts(products) {
        const container = document.querySelector("#articlelist");
        products.forEach(product => { 
            console.log("Displaying product:", product); // Log de chaque produit affiché
            container.innerHTML += this.renderProduct(product); });
    }

    renderProduct(product) {
        return `
            <div class="col-lg-4 col-sm-6 articleitem" id="article-pattern">
                <div class="b-article">
                    <div class="v-img">
                        <a href="/product/${product.id}">
                            <img src="/images/storage/${product.picture}" alt="">
                        </a>
                    </div>
                    <div class="v-desc">
                        <a href="/product/${product.id}">${product.name}</a>
                    </div>
                    <p>${product.description.slice(0, 20)}...</p>
                    <div class="v-views">
                        ${product.views} vues
                    </div>
                </div>
            </div>
        `;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOMContentLoaded event fired");
    new SearchFilter();
});

