<template>
    <div>
        <div v-if="step == 1">
            <h3>Step 1</h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select title="" class="form-control" v-model="main_category">
                            <option value="0">- please choose category -</option>
                            <option v-if="!category.parent_id" :value="category.id" v-for="category in categories">{{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3" v-if="main_category">
                    <div class="form-group">
                        <select class="form-control" v-model="category">
                            <option value="0">- please choose category -</option>
                            <option v-if="category.parent_id == main_category" :value="category.id" v-for="category in categories">{{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3" v-if="category">
                    <div class="form-group">
                        <select class="form-control" v-model="advert.subcategory_id">
                            <option value="0">- please choose sub category -</option>
                            <option :value="category.id" v-for="category in subcategories">{{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3" v-if="advert.subcategory_id">
                    <div class="form-group">
                        <p>
                            <button v-on:click="step = 2" class="btn btn-success">Continue</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="step == 2">
            <h3>Step 2</h3>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="text">Advert text</label>
                        <textarea style="resize: none" class="form-control" name="" id="text" cols="30" rows="10" v-model="advert.text"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="number">Phone number</label>
                        <input class="form-control" type="tel" id="number" name="number">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail address</label>
                        <input class="form-control" type="email" id="email" name="email">
                    </div>
                    <div class="form-group text-right">
                        <button v-on:click="publish()" class="btn btn-success">Publish</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            'category_list'
        ],
        data() {
            return {
                categories: JSON.parse(this.category_list),
                subcategories: [],
                step: 1,
                main_category: 0,
                category: 0,
                advert: {
                    category_id: 0,
                    subcategory_id: 0,
                    text: ''
                }
            }
        },
        mounted() {
            console.log(this.categories);
        },
        watch: {
            main_category: function () {
              this.category = 0;
            },
            category: function () {
                this.subcategories = this.categories[this.category].subcategories;
            }
        },
        methods: {
            publish() {
                this.advert.category_id = this.category;
                this.$http.post('/adverts/add/', this.advert).then(function(response) {
                    location.href = response.data.redirect;
                });
            }
        }
    }
</script>
