<section id="comments">
    @foreach ($topic->comments as $comment)
        @include ('comment', array('comment' => $comment))
    @endforeach
</section>

{{
    Form::open(
        array(
            'url' => URL::to('comment'),
            'class' => 'form-horizontal ajax'
        )
    )
}}

    {{
        Form::textarea(
            'comment',
            '',
            array(
                'id' => 'comment',
                'class' => 'form-control',
                'placeholder' => 'comment'
            )
        )
    }}

    {{
        Form::submit(
            'Submit',
            array(
                'class' => 'btn btn-primary'
            )
        )
    }}

    {{
        Form::button(
            'Preview',
            array(
                'class' => 'btn btn-info'
            )
        )
    }}

{{ Form::close() }}
