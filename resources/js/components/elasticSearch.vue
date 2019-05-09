<template>
    <div class="input-group ">
        <input type="text" v-model='query'  class="form-control" placeholder="ElasticSearch ..."  aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary"  type="button">Search</button>
        </div>
    </div>
      
</template>
<script>
import _ from 'lodash'

export default {
    data(){
        return {
            'query':''
        }
    },
    methods:{
        search(){
            axios.post('/company/search',{'text':this.query}).then((res)=>{
                console.log(res.data.result);
            })
        }
    },
    watch:{
        query:_.debounce(function (){
            if(this.query){
                this.search()
            }       
        },2000)
    }
}
</script>