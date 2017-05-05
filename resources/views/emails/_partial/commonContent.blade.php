<?php
$style = [
        'font-family' => 'font-family: Arial;',

    /* Layout ------------------------------ */

        'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
        'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

        'email-masthead' => 'padding: 25px 0; text-align: center;',
        'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

        'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
        'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
        'email-body_cell' => 'padding: 35px;',

        'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
        'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

        'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
        'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

        'anchor' => 'color: #3869D4;',
        'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
        'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
        'paragraph-sub' => 'font-family: Arial; font-size: 12px; margin-top: 0; color: #74787E; line-height: 1.5em;',
        'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

        'button' => 'display: block; width: 200px; min-height: 20px; padding: 10px;
        background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
        text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

        'button--green' => 'background-color: #22BC66;',
        'button--red' => 'background-color: #dc4d2f;',
        'button--blue' => 'background-color: #3869D4;',
];
?>
        <!-- Greeting -->
<h1 style="{{ $style['header-1'] }}">
    @if (! empty($greeting))
        {{ $greeting }}
    @else
        @if ($level == 'error')
            Ops!
        @else
            Olá!
        @endif
    @endif
</h1>

<!-- Intro -->
@foreach ($introLines as $line)
<p style="{{ $style['paragraph'] }}">
    {{ $line }}
</p>
@endforeach

<!-- Action Button -->
@if (isset($actionText))
    <table style="{{ $style['body_action'] }}" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="{{ $style['font-family'] }}" align="center">
                <?php
                switch ($level) {
                    case 'success':
                        $actionColor = 'button--green';
                        break;
                    case 'error':
                        $actionColor = 'button--red';
                        break;
                    default:
                        $actionColor = 'button--blue';
                }
                ?>

                <a href="{{ $actionUrl }}"
                   style="{{ $style['font-family'] }} {{ $style['button'] }} {{ $style[$actionColor] }}"
                   class="button"
                   target="_blank">
                    {{ $actionText }}
                </a><br>
            </td>
        </tr>
    </table>
@endif

<!-- Outro -->
@foreach ($outroLines as $line)
    <p style="{{ $style['paragraph'] }}">
        {{ $line }}
    </p>
@endforeach

<!-- Sub Copy -->
@if (isset($actionText))
    <table style="{{ $style['body_sub'] }}">
        <tr>
            <td style="{{ $style['font-family'] }}">
                <p style="{{ $style['paragraph-sub'] }}">
                    Se você está tendo problemas em clicar no botão "{{ $actionText }}",
                    copie e cole a URL abaixo em seu navegador:<br>
                    <a style="{{ $style['anchor'] }}" href="{{ $actionUrl }}" target="_blank">
                        {{ $actionUrl }}
                    </a>
                </p>
            </td>
        </tr>
    </table>
@endif