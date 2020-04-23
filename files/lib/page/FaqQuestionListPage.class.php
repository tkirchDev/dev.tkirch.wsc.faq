<?php
namespace wcf\page;
use wcf\data\faq\Question;
use wcf\data\faq\QuestionList;
use wcf\system\WCF;
use wcf\data\category\CategoryNodeTree;

class FaqQuestionListPage extends AbstractPage {

	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();

		//get categories
		$faqs = [];
		$categoryTree = new CategoryNodeTree('dev.tkirch.wsc.faq.category');
		foreach($categoryTree->getIterator() as $category) {
			$faqs[$category->categoryID] = [];
			$faqs[$category->categoryID]['title'] = $category->title;

			$questionList = new QuestionList();
			$questionList->getConditionBuilder()->add('categoryID = '.$category->categoryID);
			$questionList->readObjects();

			$faqs[$category->categoryID]['questions'] = $questionList->getObjects();
		}

		WCF::getTPL()->assign([
            'faqs' => $faqs
		]);
	}
}