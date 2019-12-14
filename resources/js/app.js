require('./bootstrap');

import Vue from 'vue'
import ToggleComponent from './components/ToggleComponent'
import ToggleableItem from './components/ToggleableItem'
import TogglingTrigger from './components/TogglingTrigger'
import PostForm from './components/PostForm'
import PostTable from './components/PostTable'
import SearchFilter from './components/SearchFilter'
import PostWrapper from './components/PostWrapper'
import CategoryWrapper from './components/CategoryWrapper'
import CategoryForm from './components/CategoryForm'
import CategoryTable from './components/CategoryTable'
import PostComponent from './components/PostComponent'

const app = new Vue({
    el: '#app',
    components: {CategoryForm, CategoryTable, CategoryWrapper, ToggleComponent, TogglingTrigger, ToggleableItem, PostForm, PostTable, PostWrapper, SearchFilter, PostComponent}
});
