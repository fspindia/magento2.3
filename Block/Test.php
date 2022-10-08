<?php

namespace Bss\EmailDemo\Block;


class Test
{
    private $blockRepository;
    private $blockInterfaceFactory;
    public function __construct(
        \Magento\Cms\Api\BlockRepositoryInterface $blockRepository,
        \Magento\Cms\Api\Data\BlockInterfaceFactory $blockInterfaceFactory

    )
    {
        $this->blockRepository = $blockRepository;
        $this->blockInterfaceFactory = $blockInterfaceFactory;
    }
    public function text()
    {
        $block = $this->blockInterfaceFactory->create();
        $block->setContent('test');
        $block->setIdentifier('abc');
        $block->setTitle('my title');

        $this->blockRepository->save($block);
    }

}
