<?php
// source: /home/users/xh/xhamer02/WWW/IIS/app/presenters/templates/Homepage/default.latte

class Templatebc07410eea6de398a478810d6bbe1ad9 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('87bfb16b1a', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb99508c8abb_content')) { function _lb99508c8abb_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div>Hello world!</div>

<?php $iterations = 0; foreach ($more_vole_cigan as $cigan) { ?><div class="leky">
    <p><?php echo Latte\Runtime\Filters::escapeHtml($cigan->pacient_jmeno, ENT_NOQUOTES) ?></p>
    
<?php $iterations = 0; foreach ($cigan->related('polozkaRez') as $hovno) { ?>
            <div><?php echo Latte\Runtime\Filters::escapeHtml($hovno->lek->nazev, ENT_NOQUOTES) ?></div>
        
<?php $iterations++; } ?>
    
</div>
<?php $iterations++; } 
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}