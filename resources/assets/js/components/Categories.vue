<template>
    <div style="position: relative">

        <transition name="slide-fade">
            <div v-if="categoryKey == 0" class="button-group text-center">
                <button v-for="category in categories[0]" v-if="!category.parent_id" v-on:click.prevent="nextLevel(category)" class="btn category-title" v-bind:class="'btn-' + category.color">
                    {{ category.translation.name }}
                </button>
            </div>
        </transition>

        <transition name="slide-fade">
            <div v-if="categoryKey > 0 && show" style="position: absolute; top: 0">
                <ol class="breadcrumb">
                    <li v-for="crumb in breadcrumbs">
                        <a v-on:click.prevent="decreaseKey(crumb.key)">{{ crumb.name }}</a>
                    </li>
                </ol>
                <ul class="subcategories">
                    <li v-for="category in categories[categoryKey]">
                        <a v-on:click.prevent="nextLevel(category)" href="#">{{ category.translation.name }}</a>
                    </li>
                </ul>
            </div>
        </transition>

    </div>
</template>

<script>
    export default {
        props: [
            'category_list',
            'adverts_route'
        ],
        data() {
          return {
              categories: [
                  JSON.parse(this.category_list)
              ],
              categoryKey: 0,
              breadcrumbs: [
                {
                  'key': 0,
                  'name': 'Home'
                }
              ],
              categorySlug: null,
              show: true, // for transition
              redirect: false // true if subcategories was rendered
            }
        },
        watch: {
            categoryKey: function () {
                let self = this;
                this.show = false;
                setTimeout(function() {
                    self.show = true;
                },200);
            }
        },
        methods: {
            nextLevel(category) {
                this.generateNextCategories(category);
                this.increaseKey();
            },
            increaseKey() {
                this.categoryKey++;
            },
            decreaseKey(key) {

                let deleteFrom = key + 1;
                this.breadcrumbs.splice(deleteFrom,2);
                this.categoryKey = key;
                this.redirect = false;

            },
            generateNextCategories(category) {

                // Redirect or not
                if (this.redirect) {
                    location.href = '/adverts/' + this.categorySlug + '/' + category.slug + '/';
                    return false;
                }

                let key = this.categoryKey,
                    increasedKey = key + 1;

                this.breadcrumbs.push({
                    'key' : increasedKey,
                    'name': category.translation.name
                });
                this.categories[increasedKey] = [];

                // generate subcategories
                if (category.subcategories.length) {
                    this.redirect = true;
                    this.categorySlug = category.slug;
                    this.categories[increasedKey] = category.subcategories;
                } else { // generate next level categories
                    this.redirect = false;
                    for (let i=0; i < this.categories[key].length; i++) {
                        if (this.categories[key][i].parent_id == category.id) {
                            this.categories[increasedKey].push(this.categories[key][i]);
                        }
                    }
                }
            }
        }
    }
</script>
