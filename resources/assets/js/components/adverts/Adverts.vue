<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Filters</h3>
            </div>
            <div class="panel-body">
                <div class="form-inline">
                    <div class="form-group">
                        <p>
                            <label for="show">Show</label>
                        </p>
                        <select class="form-control" name="show" id="show" v-model="showAs">
                            <option value="table">Table</option>
                            <option value="grid">Grid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <p>
                            <label for="per_page">Per page</label>
                        </p>
                        <select class="form-control" name="per_page" id="per_page" v-model="perPage" v-on:change="changePerPage">
                            <option>2</option>
                            <option>4</option>
                            <option>6</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <table v-if="showAs == 'table'" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="1">id</th>
                    <th>text</th>
                    <th v-if="filter.main" v-for="filter in category.filters">
                        {{ filter.name }}
                    </th>
                    <th width="1">created</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="advert in adverts.data">
                    <td>{{ advert.id }}</td>
                    <td>
                        <a :href="advert.id">
                            {{ advert.text }}
                        </a>
                    </td>
                    <th v-if="filter.main" v-for="filter in category.filters">
                         {{ advert.idFilters[filter.id] ? advert.idFilters[filter.id].value : '' }}
                    </th>
                    <td>{{ advert.created_at }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row" v-if="showAs == 'grid'">
            <div class="col-sm-6 col-md-4" v-for="advert in adverts.data">
                <div class="thumbnail">
                    <div class="caption">
                        <p>
                            <a href="">
                                {{ advert.text }}
                            </a>
                        </p>
                        <p><a href="#" class="btn btn-primary" role="button">Open</a></p>
                    </div>
                </div>
            </div>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li v-bind:class="{disabled: adverts.current_page == 1}">
                    <a v-if="adverts.current_page != 1" v-on:click.prevent="prevPage" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    <span v-if="adverts.current_page == 1" aria-hidden="true">&laquo;</span>
                </li>
                <li v-bind:class="{active: page == adverts.current_page}" v-for="page in totalPages">
                    <a v-on:click.prevent="jumpToPage(page)" v-if="page != adverts.current_page" href="#">{{ page }}</a>
                    <span v-if="page == adverts.current_page">{{ page }}</span>
                </li>
                <li v-bind:class="{disabled: adverts.current_page == adverts.last_page}">
                    <a v-if="adverts.current_page != adverts.last_page" v-on:click.prevent="nextPage" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    <span v-if="adverts.current_page == adverts.last_page" aria-hidden="true">&raquo;</span>
                </li>
            </ul>
        </nav>

    </div>
</template>

<script>
    export default {
        props: [
            'advert_list',
            'category_list',
            'subcategory_list'
        ],
        data() {
            return {
                adverts: JSON.parse(this.advert_list),
                category: JSON.parse(this.category_list),
                subcategory: JSON.parse(this.subcategory_list),
                totalPages: 1,
                perPage: 2,
                showAs: 'table',
                test: { "id": 3, "advert_id": 1, "filter_id": 3, "value": "9:00", "created_at": null, "updated_at": null, "values": { "id": 3, "category_id": 13, "name": "work_time", "main": 1, "type": "input", "value": "", "created_at": null, "updated_at": null } }
            }
        },
        mounted() {
            console.log(this.adverts);
            this.totalPages = Math.ceil(this.adverts.total / this.adverts.per_page);
        },
        watch: {
            adverts: function () {
                this.totalPages = Math.ceil(this.adverts.total / this.adverts.per_page);
            }
        },
        methods: {
            nextPage() {
                this.$http.get(this.adverts.next_page_url+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            },
            prevPage() {
                this.$http.get(this.adverts.prev_page_url+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            },
            jumpToPage(page) {
                this.$http.get(location.href + '?page='+page+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            },
            changePerPage() {
                this.$http.get(location.href + '?page='+this.adverts.current_page+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            }
        }
    }
</script>
