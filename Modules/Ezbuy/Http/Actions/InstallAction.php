<?php

namespace Modules\Ezbuy\Http\Actions;

use Modules\Admin\Http\Actions\AbstractAction;
// use Modules\Admin\Entities\Module;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Events\ProductUpdated;
use App\Models\Buyforme;

class InstallAction extends AbstractAction
{
    public function __construct($dataType, $data)
    {
        $this->dataType = $dataType;
        $this->data = $data;
        $this->data = $data;
        $this->isBulk = false;
        $this->isSingle = true;
    }

    public function getTitle($actionParams = ['type'=>false, 'id'=>false])
    {
        if ($actionParams['type']) {
            if (isset($actionParams['id']) && $actionParams['id']) {
                return 'Scrape';
            }
            return 'No ID';
        }
        return 'No Type';
    }

    public function getIcon()
    {
        return 'fas fa-plug';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes($actionParams = ['type'=>false])
    {
        $type = $actionParams['type'] ?? ['type'=>false];
        if ($type == 'single') {
            return [
                'class' => 'btn btn-sm btn-primary pull-right'
            ];
        } else if ($type == 'widget') {
            return [
                'class' => 'ui button item btn-loading'
            ];
        }
        return [
            'class' => 'btn btn-primary btn-loading',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.modules.index');
    }


    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'buyformes';
    }

    public function massAction($ids, $comingFrom)
    {
        if (is_array($ids) && $ids[0]) {
            foreach ($ids as $id) {
                $product = Buyforme::find($id);
                if (!$product) { dd('error'); }
                $process = Process::fromShellCommandline(sprintf(
                    'cd %s && node resources/scraper/mercari.js 1 --id=%s --noloop=true',
                    base_path(),
                    $id
                ), null, ['COMPOSER_HOME' => getenv('COMPOSER_HOME')]);
                $process->setTimeout(480);
                $process->run();
                // executes after the command finishes
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                } else {
                    ProductUpdated::dispatch($product);
                }
                $output = json_decode($process->getOutput()); 
            }
        }
        return redirect($comingFrom);
    }

    private function isUrl($url){
        return preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $url);
    }
}