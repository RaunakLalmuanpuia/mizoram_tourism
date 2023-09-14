<template>
    <div class="container mt-10  px-8  ">

       

 
        <div class="mb-6 text-black text-2xl mx-2 font-semibold">Hotel Reports</div>

        <div>
            <input type="date" v-model="mCalender" @click="calenderClick">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="bg-white border border-gray-300">
                <ul  v-for="value in eg" :key="value">
 
                    <li>
                        {{ value }}
                    </li>

                </ul>
            </div>
            <div>

            </div>
        </div>
    
              
    </div>

</template>

<script>
export default {
    data(){
        return{
            eg:["1","2","3"],
            mCalender:null,
         }
    },

    methods: {
        calenderClick() {
            
        },
    },

}
</script>