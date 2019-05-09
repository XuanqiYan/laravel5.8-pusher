<template>
    <div>
        <h2>Chat Room</h2>    
        <ul class='list-group'>
            <li class='list-group-item'  v-for='message in messages'>
                <p>{{ message.message }}</p>
                <small class='text-uted'>{{ message.created_time }}</small>
                <small>{{ message.user.name }}</small>
            </li>
        </ul>  
        <div class="form-group mt-4">
            <input v-show='show' type="text" class='form-control' v-model='newMessage' @keyup.enter='sendMessage' placeholder="Send Somthing....">
        </div> 
    </div>
</template>
<script>
import Pusher from 'pusher-js'; // npm i pusher-js
Pusher.logToConsole = true; //开启 pusher的调控输出
/*  为了解决第三者刷新能看到聊天信息 将此处重构到vue中
    let options = {
        cluster: 'mt1',
        forceTLS: true,
        authEndpoint: '/pusher/auth',//  定义验证的路由 
        auth: {
            headers : {
                'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content//解决csrf验证问题
            }
        }   
    };
    const pusher = new Pusher('d55b0fb7bce4250f5dd6', options);
*/
export default {
    props:{
        route: String,
        channel : String
    },
    data(){
        return {
            messages:[],
            newMessage:'',
            socket_id:'',
            options:{
                cluster: 'mt1',
                forceTLS: true,
                authEndpoint: '/pusher/auth',//  定义验证的路由 
                auth: {
                    headers : {
                        'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content//解决csrf验证问题
                    }
                }   
            },
            show:false
        }
    },
    created(){
        
        this.pusher();// 监听频道中的事件
    },
    methods:{
        pusher(){
            const pusher = new Pusher('d55b0fb7bce4250f5dd6', this.options);
            var channel = pusher.subscribe(this.channel);//订阅频道
            pusher.connection.bind('connected',()=>{ //订阅频道后获取连接后的socketId
                this.socket_id = pusher.connection.socket_id
            })
            channel.bind('pusher:subscription_succeeded',()=>{//通过auth认证后才能获取聊天信息
                this.ftechMessages();//获取历史聊天数据
                this.show=true;
            });
            channel.bind('pusher:subscription_error',()=>{
                alert('您无权获取当前聊天内容～')
            })
            channel.bind('new-message',(res)=>{//监听事件
                this.messages.push(res);
            })
        },
        ftechMessages(){
            axios.get(this.route + '/messages' ).then((res)=>{
                this.messages = res.data.messages
            })
        },
        sendMessage(){
            //必须带上socket_id 否则自身也能监听到自己发送的事件
            axios.post(this.route + '/store',{ message:this.newMessage ,socket_id: this.socket_id }).then((res)=>{
                this.messages.push(res.data.mes);
                this.newMessage = '';
            })
        }
    }

}
</script>