<?php

namespace App\GraphQL\Mutations\Auth;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\SmsCode;
use Illuminate\Support\Carbon;

class SmsLogin
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
        $user = User::where('phone',$data['phone'])->first();
        // 登录 生成token
        $token = $user->createToken('minapp',['*'])->accessToken;
        return [
            'status'=> '200',
            'message'=>'登录成功!',
            'data'=>[
                'access_token'=>$token,
                'user'=>$user
            ]
        ];
    }
    public function validate($data){
        $rules = [
            'phone'=>['required','regex:/^\\d{1}\\d{10}$/'],
            'code'=>['required','regex:/^\\d{1}\\d{5}$/'],
        ];
        $messages = [
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>'手机号为11位',
            'code.required'=>'验证码不能为空',
            'code.regex'=>'手机号为6位',
        ];
        $validate = Validator::make($data,$rules,$messages);
        if ($validate->fails()) {
            throw new \InvalidArgumentException($validate->messages()->first());
        }
        $oldCode = SmsCode::where('phone',$data['phone'])->where('expired_at','>',Carbon::now()->format('Y-m-d H:i:s'))->first();
        if ($oldCode){
            if ($oldCode->code !== $data['code']){
                throw new \Exception('验证码不正确!');
            }
            $oldCode->delete();
        } else {
            throw new \Exception('请先发送验证码!');
        }
        return true;
    }
}
