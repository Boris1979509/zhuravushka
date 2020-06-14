@extends('layouts.app')

@section('title', $page->title)

@section('description', $page->description)

@section('content')
    @include('components.pageNavMenu')
    <section id="contacts">
        <div class="container">
            <div class="row">
                <div class="contacts">
                    <div class="contacts__content">
                        <p class="contacts__title">Контакты</p>
                        <div class="contacts__props">
                            <p class="contacts__props-name">Адрес:</p>
                            <p class="contacts__props-value">
                                307910 Курская обл. Беловский р-он сл. Белая ул. Журавского 19
                            </p>
                        </div>
                        <div class="contacts__props">
                            <p class="contacts__props-name">Телефон:</p>
                            <p class="contacts__props-value">
                                8 (961) 196-3000
                            </p>
                        </div>
                        <div class="contacts__props">
                            <p class="contacts__props-name">E-mail:</p>
                            <p class="contacts__props-value">
                                <a href="#" class="link contact-email-link">zhyravyshka@mail.ru</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
