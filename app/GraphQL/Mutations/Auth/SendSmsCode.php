<?php

namespace App\GraphQL\Mutations\Auth;

use App\Models\SmsCode;
use App\Models\User;
use App\Notifications\VerificationCode;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
class SendSmsCode
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        //查询用户是否存在
        $data = $args['input'];
        $this->validate($data);
        $data['password'] = bcrypt('123456');
        $data['name'] = '';
        $data['email'] = '';
        $user = User::where('phone',$data['phone'])->first();
        if(!$user){
            $user = User::create($data);
        }
        //查询2分钟内是否已经发送过
        $oldCode = SmsCode::where('phone',$data['phone'])->where('expired_at','>',Carbon::now()->format('Y-m-d H:i:s'))->first();
        if ($oldCode){
            throw new \Exception('两分钟后在重试!');
        }
        //发送验证码
        $user->notify(new VerificationCode());
        return [
            'status'=> '200',
            'message'=>'发送成功'
        ];
    }
    public function validate($data){
        $rules = [
            'phone'=>['required','regex:/^\\d{1}\\d{10}$/'],
        ];
        $messages = [
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>'手机号为11位',
        ];
        $validate = Validator::make($data,$rules,$messages);
        if ($validate->fails()) {
            throw new \InvalidArgumentException($validate->messages()->first());
        }
        return true;
    }
}
