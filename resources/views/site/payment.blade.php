                     <!-- F -->
        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-login" class="section allow active">
            <div class="step-title"><span class="number">+</i></span>
              <h3 class="one_page_heading">ÖDEME TİPİ</h3>
            </div>
          </li>
        </ol>

                <!-- F -->

                    @foreach($payments as $payment)

                    @if ($payment->id_payment=='1')
                      <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $payment->id_payment }}" name="payment" value="{{ $payment->id_payment }}"> <label for="c{{ $payment->id_payment }}" style="font-weight:normal; display:inline-block;">{{ $payment->name }}</label></div>

        <!-- K -->
        <div id="cardpayment">

        <table id="form_listele">
        <thead>
          <tr>
        <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
        <tr><td colspan="3"><h4 class="cardinfo" style="padding-top:15px;"><i class="glyphicon glyphicon-credit-card"></i> KART BİLGİLERİNİZ</h4></td></tr>
          <tr>
        <td>Kart Sahibi</td>
        <td style="padding-left:20px;"></td>
        <td><input type="text" name="ccname" id="ccname" class="input-text" style="border:1px solid #B5B5B5; margin-bottom:5px;">   
        </td>
        </tr>
          <tr>
        <td>Kart Numarası</td>
        <td style="padding-left:20px;"></td>
        <td><input type="text" name="ccno" id="ccno" class="input-text" style="border:1px solid #B5B5B5; margin-bottom:5px;"></td>
        </tr>
          <tr>
        <td>Son Kullanma</td>
        <td style="padding-left:20px;"></td>
        <td>
        <select name="ccmonth" style="width:125px; border:1px solid #B5B5B5; margin-bottom:5px;">
          <option value="01" selected>01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>   
        {!! Form::selectYear('ccyear',date('Y'),date('Y')+15,date('Y'),['style'=>'width:125px; border:1px solid #B5B5B5; margin-bottom:5px;']) !!}
        </td>
        </tr>
          <tr>
        <td>CVV</td>
        <td style="padding-left:20px;"></td>
        <td><input type="text" name="cvv" class="input-text" style="width:60px; border:1px solid #B5B5B5; margin-bottom:5px;"><input type="hidden" name="IsFormSubmitted" value="submitted" /></td>
        </tr>
          </tbody>
        </table>

        <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              @foreach($banks as $bank)
              <th><img src="{{ URL::to($bank->image) }}" alt="{{ $bank->name }}"> </a></th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach($banks as $bank)
              <td>{!! BankOperation::installment($bank->id_group,$total->grandTotal,'payment') !!}</td>
              @endforeach      
            </tr>
          </tbody>
        </table>
        </div>
        
        </div>
        <!-- K -->

                    @elseif ($payment->id_payment=='4')
                      <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $payment->id_payment }}" name="payment" value="{{ $payment->id_payment }}"> <label for="c{{ $payment->id_payment }}" style="font-weight:normal; display:inline-block;">{{ $payment->name }}</label> <a href="{{ URL::to($settings->bank_transfer_url) }}" target="_blank" style="color:#999999; padding-left:20px;">(Banka Bilgileri)</a></div>

                    @elseif ($payment->id_payment=='5')
                      <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $payment->id_payment }}" name="payment" value="{{ $payment->id_payment }}"> <label for="c{{ $payment->id_payment }}" style="font-weight:normal; display:inline-block;">{{ $payment->name }}</label> <a href="{{ URL::to($settings->bank_transfer_url) }}" target="_blank" style="color:#999999; padding-left:20px;">(Posta Çeki Hesap Bilgileri)</a></div>                      

                    @else
                      <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $payment->id_payment }}" name="payment" value="{{ $payment->id_payment }}"> <label for="c{{ $payment->id_payment }}" style="font-weight:normal; display:inline-block;">{{ $payment->name }}</label></div>
                    @endif

                      <br />
                    @endforeach