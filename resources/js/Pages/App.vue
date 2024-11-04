<script setup>
import {ref} from "vue";
import {Products} from "../../../public/js/modules/models/Products.js";
import MainMenu from "@/Pages/Components/MainMenu.vue";
import ProductList from "@/Pages/Components/ProductList.vue";

let Menu = {
	items: [
		{
			id: 0,
			slug: "counter",
			active: true,
			text: "Counter",
			iconClass: ''
		},
		'separator',
		{
			id: 1,
			slug: "settings",
			active: false,
			text: "Settings",
			iconClass: ''
		}
	],
	setActive: function (id) {
		console.log(this)
		for (let item of this.items) {
		    if (item == "separator") continue;
		    item.active = item.id === id;
		}
	},
	getActiveMenu: function (){
		for (let item of this.items) {
			if (item == "separator") continue;
			if (item.active) return item
		}
	}
}
function setActiveMenu(id) {
	Menu.setActive(id)
}

const productList= ref([]);
Products.get().then((products)=>{productList.value=products.values()})
</script>

<template>
    <MainMenu :menuItems="Menu.items" @menuClick="setActiveMenu"/>
	<ProductList v-if="Menu.getActiveMenu().slug==='counter'" :productList/>
</template>

<style scoped>

</style>
