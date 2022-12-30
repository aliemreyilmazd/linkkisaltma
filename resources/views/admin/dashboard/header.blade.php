<div class="bg-base-0">

    <div class="container py-5">

        <div class="d-flex">

            <div class="row no-gutters w-100">

                <div class="d-flex col-12 col-md">

                    <div class="flex-grow-1 d-flex align-items-center">

                        <div>

                            <h2 class="font-weight-medium mb-0">{{ config('settings.title') }}</h2>



                            <div class="text-muted mt-2">

                                <div class="d-inline-block {{ (__('lang_dir') == 'rtl' ? 'ml-4' : 'mr-4') }}">

                                    <div class="d-flex">

                                        <div class="d-inline-flex align-items-center">

                                            @include('icons.info', ['class' => 'fill-current width-4 height-4'])

                                        </div>



                                        <div class="d-inline-block {{ (__('lang_dir') == 'rtl' ? 'mr-2' : 'ml-2') }}">

                                            Hızlı Şekilde Link Kısaltın

                                        </div>

                                    </div>

                                </div>



                                <div class="d-inline-block {{ (__('lang_dir') == 'rtl' ? 'ml-4' : 'mr-4') }}">

                                    <div class="d-flex">

                                        <div class="d-inline-flex align-items-center">

                                            @include('icons.key', ['class' => 'fill-current width-4 height-4'])

                                        </div>



                                        <div class="d-inline-block {{ (__('lang_dir') == 'rtl' ? 'mr-2' : 'ml-2') }}">

                                            <a href=""><span class="badge badge-primary">Ali Emre Yılmaz - Kocaeli Üniversitesi</span></a>

                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>



                <div class="col-12 col-md-auto d-flex flex-row-reverse align-items-center"></div>

            </div>

        </div>

    </div>

</div>