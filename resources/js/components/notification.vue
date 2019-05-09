<template>
    <div>
        
        <h1>notification</h1>
    </div>
</template>
<script>
import Pusher from 'pusher-js'; 
import toastr from '../toastr';
Pusher.logToConsole = true;  
let options = {
        cluster: 'mt1',
        forceTLS: true,
        authEndpoint: '/notification/auth',//  定义验证的路由 
        auth: {
            headers : {
                'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content//解决csrf验证问题
            }
        }   
    };
const pusher = new Pusher('d55b0fb7bce4250f5dd6', options);
export default {
    props:[ 'loginuser'],
    created(){
        //console.log('aaa');      
        var channel = pusher.subscribe('private-notification-' + this.loginuser);
        channel.bind('notification',(mes)=>{
            let options = {
                "closeButton":true,
                "newestOnTop":true,
                "positionClass":"toast-top-right",
                "preventDuplicates":false,
                "timeOut":"0",
                "extendedTimeOut":"0",
                "onclick":function(){
                    window.location.href='/chat/'+ mes.chat_id
                }
            }
            //console.log(toastr);
            toastr.success(mes.message,mes.user.name,options)
        });
    }  
}
</script>
