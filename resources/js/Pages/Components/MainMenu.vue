<script setup>
const props = defineProps(['menuItems']);
const emit = defineEmits(['menuClick']);


</script>

<template>
	<nav id="mainMenu">
		<ul>
			<li v-for="item in menuItems"
				:class="[(item=='separator')?'separator':'menu-item',
				(item?.active===true)?'active':null]">
				<a v-if="!(item == 'separator')" href="#"
				   @click.prevent="$emit('menuClick',item.id)">{{ item.text }}</a>
			</li>
		</ul>
	</nav>
</template>

<style scoped>
#mainMenu {
	.menu-item.active {
		text-decoration : underline;
	}
	a {
		text-decoration : none;
		color           : inherit;
	}
}
</style>
