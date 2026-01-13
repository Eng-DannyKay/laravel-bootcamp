<?php

it('can render', function () {
    $contents = $this->view('chirp', [
        //
    ]);

    $contents->assertSee('');
});
