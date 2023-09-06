@extends('backend.layout.app')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <p class="h3">Wester Park Studio</p>
                            <address>
                                Zeebergweg 2 1051DE <br>
                                Amsterdam<br>
                                +31 (0)6 3402 6844<br>
                                info@westerparkstudio.nl
                            </address>
                        </div>
                        <div class="col-4">
                            <img src="/logo.jpg" class="img-fluid" alt="...">
                        </div>
                        <div class="col-4 text-end">
                            <p class="h3">Client</p>
                            <address>
                                Street Address<br>
                                State, City<br>
                                Region, Postal Code<br>
                                ctr@example.com
                            </address>
                        </div>

                        <div class="flex jus justify-content-between my-5">
                            <div>asd</div>
                            <div>asd</div>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 1%"></th>
                            <th>Product</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-end" style="width: 1%">Unit</th>
                            <th class="text-end" style="width: 1%">Amount</th>
                        </tr>
                        </thead>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <p class="strong mb-1">Logo Creation</p>
                                <div class="text-muted">Logo and business cards design</div>
                            </td>
                            <td class="text-center">
                                1
                            </td>
                            <td class="text-end">$1.800,00</td>
                            <td class="text-end">$1.800,00</td>
                        </tr>

                        <tr>
                            <td colspan="4" class="strong text-end">Subtotal</td>
                            <td class="text-end">$25.000,00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Discount</td>
                            <td class="text-end">21%</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Vat Rate</td>
                            <td class="text-end">21%</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Vat Due</td>
                            <td class="text-end">$5.000,00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                            <td class="font-weight-bold text-end">$30.000,00</td>
                        </tr>
                    </table>
                    <p class="text-muted text-center mt-5">
                        Thank you very much for doing business with us.
                        We look forward to working with
                        you again!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">

                </h2>
            </div>

            <div class="col-12 col-md-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                    Send PDF
                </button>
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                    Download PDF
                </button>
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                    Print Invoice
                </button>
            </div>
        </div>
    </div>

@endsection
