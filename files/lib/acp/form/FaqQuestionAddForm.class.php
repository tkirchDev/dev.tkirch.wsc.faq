<?php
namespace wcf\acp\form;
use wcf\form\AbstractFormBuilderForm;
use wcf\system\WCF;
use wcf\system\form\builder\container\FormContainer;
use wcf\system\form\builder\field\TextFormField;
use wcf\system\form\builder\field\MultilineTextFormField;
use wcf\data\faq\QuestionAction;
use wcf\system\form\builder\field\SingleSelectionFormField;
use wcf\system\category\CategoryHandler;

class FaqQuestionAddForm extends AbstractFormBuilderForm {

	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.faq.questions.add';
	
	/**
	 * @inheritDoc
	 */
	public $formAction = 'create';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.faq.canAddQuestion'];
	
	/**
	 * @inheritDoc
	 */
	public $objectActionClass = QuestionAction::class;
		
	/**
	 * @inheritDoc
	 */
	protected function createForm() {
		parent::createForm();
		$categories = CategoryHandler::getInstance()->getCategories('dev.tkirch.wsc.faq.category');
        $this->form->appendChildren([
			FormContainer::create('general')
				->label('wcf.acp.faq.question.general')
				->appendChildren([
					SingleSelectionFormField::create('categoryID')
						->label('wcf.acp.faq.category')
						->options($categories)
						->required(),
					TextFormField::create('question')
						->label('wcf.acp.faq.question.question')
						->i18n()
						->languageItemPattern('wcf.faq.question.question\d+')
						->required(),
                    MultilineTextFormField::create('answer')
						->label('wcf.acp.faq.question.answer')
						->i18n()
						->languageItemPattern('wcf.faq.question.answer\d+')
						->required()
				])
			]);
	}
}