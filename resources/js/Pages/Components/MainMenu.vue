<script setup>
import {ref} from "vue";
const props = defineProps(['menuItems']);
const emit = defineEmits(['menuClick']);

</script>

<template>
    <section id="main_menu">
        <ul>
            <li :class="[(item=='separator')?'separator':'menu-item']"
                v-for="item in menuItems">
                <a v-if="!(item == 'separator')" @click="$emit('menuClick',item.id)"
                   href="#">{{item.text}}</a>
            </li>
        </ul>
    </section>
</template>

<style scoped>

</style>
