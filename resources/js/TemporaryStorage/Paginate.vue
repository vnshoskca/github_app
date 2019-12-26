<template>
    <div>
        <ul>
            <li v-for="item in getItems">{{item}}</li>
        </ul>

        <paginate
            :page-count="getPageCount"
            :page-range="3"
            :margin-pages="2"
            :click-handler="clickCallback"
            :prev-text="'＜'"
            :next-text="'＞'"
            :container-class="'pagination'"
            :page-class="'page-item'">
        </paginate>
    </div>
</template>

<script>

    var items = [];
    for(var i=1; i<=105; i++){
    items.push('item-'+i);
    }
        
export default {
        data: function(){
            return{
                items: items,
                parPage: 10,
                currentPage: 1
            }
        },
        methods: {
            clickCallback: function (pageNum) {
            this.currentPage = Number(pageNum);
            }
        },
        computed: {
            getItems: function() {
                let current = this.currentPage * this.parPage;
                let start = current - this.parPage;
                if(items || items.length){
                    return this.items.slice(start, current);
                }
            },
            getPageCount: function() {
                return Math.ceil(this.items.length / this.parPage);
            }
        }
}
</script>