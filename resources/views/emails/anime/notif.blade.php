<div style="margin:0;padding:0;font-family: sans-serif; font-size: 14px; color: #3d3d3d;">
    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color:#f9f9f9">
        <tr>
            <td>
                <table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color:#ffff;border-collapse: collapse;">
                    <tr>
                      <td style="font-size:6px;line-height:10px;padding:0 20px;" valign="top">
                          <h1>ANIME CRAWLER</h1>
                      </td>
                    </tr>
                    <tr>
                        <td>
                            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="text-align:center; color: #3d3d3d;">
                                <tr>
                                    <td>
                                        <img src="{{ $anime['img'] }}" width="50%" style="padding-bottom:20px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 style="color:#000000;"><b>{{ $data->title }}</b></h3>
                                        <p style="margin-top: 20px;">Episode {{ $anime['episode'] }} has update</p>
                                        <p><a href="{{ route('anime.index') }}">View</a></p>
                                    </td>
                                </tr>
                                <tr>
                                  <td>
                                    <table align="center" style="width: 541px;border-radius: 3px;padding: 20px 60px; color: #3d3d3d;text-align:center;background-color: #f9f9f9;margin-top: 10px;margin-bottom:10px;">
                                      <tr>
                                        <td>
                                          <p>
                                            This is <strong>Anime Scrapper</strong> a website that crawl anime daily, notif updated anime, and store to local.
                                          </p>
                                        </td>
                                      </tr>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table  cellspacing="0" cellpadding="0" border="0" width="100%" style="border-top: 1px solid #ddd;background-color: #f5f5f5; border-collapse:collapse;height:95px;">
                                <tbody>
                                    <tr>
                                        <td width="600" style="font-size: 12px;text-align: center; padding: 10px;">
                                            <p>Copyright &#xA9; 2018  Anime Crawler.<br>All Rights Reserved.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>