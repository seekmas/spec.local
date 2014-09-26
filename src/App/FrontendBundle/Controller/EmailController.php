<?php


namespace App\FrontendBundle\Controller;

use App\BackendBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class EmailController extends CoreController
{
    /**
     * @Route("sender" , name="sender")
     */
    public function indexAction(Request $request)
    {

        $content = <<< EOF
<pre>
擀霸企业管理咨询（上海）有限公司用户，您好！
       本律师受擀霸企业管理咨询（上海）有限公司的委托，特致函于贵公司。
       根据擀霸企业管理咨询（上海）有限公司提供的材料以及告知的信息，擀霸公司曾聘用杨凯为其中国地区
负责人，负责管理公司日常运营。后擀霸公司发现杨凯在履行职务期间多次涉嫌违反单位规章制度，故擀霸公司
已于2014年9月4日解除对杨凯的管理授权，收回杨凯的管理权限。自2014年9月4日下午14:45起，杨凯不再代表
擀霸公司。现公司由法定代表人Bradley Schmidt直接管理。
       同时，杨凯因涉嫌职务侵占罪一案，上海市公安局长宁分局经侦支队已于2014年9月18日上午受理并立案
侦查。（附件一）
       此后，杨凯于2014年9月18日下午向擀霸企业管理咨询（上海）有限公司以及第三方劳务派遣公司递交
书面辞职报告。（附件二）
       由于杨凯已不是擀霸企业管理咨询（上海）有限公司职员且其行为涉嫌犯罪，请贵公司务必不要理会杨凯
向贵公司提出的任何要求。
       如您发现杨凯曾（或正）试图联系贵公司员工，要求对关于贵公司和擀霸企业管理咨询（上海）有限公司的
任何合同或其他约定事项进行变更的，请予以拒绝并及时向本律师告知。

       请及时履行，谢谢配合，顺祝商祺！


附律师联系方式：
上海市汇中律师事务所    陶冰忻律师
联系地址：上海市静安区康定路833号 邮政编码：200040
联系电话：62581571，62581880转8005
手机号码：13818243337
</pre>
EOF;

        $message = \Swift_Message::newInstance()
            ->setSubject('擀霸企业管理咨询（上海）公司告客户书')
            ->setFrom( array( '347224136@qq.com' => '陶冰忻律师' ))
            ->setTo( '446146366@qq.com' )
            ->setBody( $content  , 'text/html')
            ->attach( \Swift_Attachment::fromPath('/home/wwwroot/local/spec.local/web/杨凯辞职报告.JPG'))
            ->attach( \Swift_Attachment::fromPath('/home/wwwroot/local/spec.local/web/受案回执.JPG'))
        ;

        $transport = \Swift_SmtpTransport::newInstance( 'smtp.mxhichina.com'  , '25')
        ->setUsername( 'mot.wu@36lean.com')
        ->setPassword( 'wujiayao123');

        $this->mailer = \Swift_Mailer::newInstance( $transport);

        $this->mailer->send( $message);

    }
}