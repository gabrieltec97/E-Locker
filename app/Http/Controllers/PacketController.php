<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PacketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Packets.historic');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        return view('Packets.new-packet', [
            'units' => $units
        ]);
    }

    public function monthConverter()
    {
        $mes = date('M');

        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );

        return $mes_extenso["$mes"];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Verificações de imagem.
        $request->validate([
            'photo' => 'required',
        ]);

        $photo = $request->input('photo');

        // Remove prefixo base64
        $image = str_replace('data:image/png;base64,', '', $photo);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        // Define nome do arquivo
        $filename = Str::uuid() . '.png';

        // Caminho completo
        $path = public_path('uploads/fotos');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true); // cria diretório se não existir
        }

        $fullPath = $path . '/' . $filename;

        // Salva o arquivo
        file_put_contents($fullPath, $imageData);

        // Caminho acessível publicamente (opcional salvar no banco)
        $publicPath = 'uploads/fotos/' . $filename;

        $packet = new Packet();
        $packet->unit = $request->unit;
        $packet->owner = $request->recipient;
        $packet->received_by = $request->receiver;
        $packet->comments = $request->comments;
        $packet->status = 'Aguardando Retirada';
        $packet->received_at = date('d/m/Y - H:i:s');
        $packet->day = date('d');
        $packet->month = $this->monthConverter();
        $packet->image = $publicPath;
        $packet->save();

        return redirect()->back()->with('msg-success', 'Entrega cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $packet = Packet::find($id);

        return view('Packets.packet', [
            'packet' => $packet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->status == 'Cancelado'){
            $packet = Packet::find($id);
            $packet->status = $request->status;
            $packet->save();

            return redirect()->route('entregas.index')->with('msg-success', 'Registro cancelado com sucesso!');
        }
        //Validação da assinatura.
        $request->validate([
            'signature' => 'required',
        ]);

        $dataUrl = $request->input('signature');

        $image = str_replace('data:image/png;base64,', '', $dataUrl);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        $filename = Str::uuid() . '.png';
        $path = public_path('uploads/signatures');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $fullPath = $path . '/' . $filename;
        file_put_contents($fullPath, $imageData);

        $publicPath = 'uploads/signatures/' . $filename;

        $packet = Packet::find($id);
        $packet->withdrawn_at = date('d/m/Y - H:i:s');
        $packet->withdrawn_by = $request->withdrawn;
        $packet->status = $request->status;
        $packet->signature = $publicPath;
        $packet->save();

        return redirect()->route('entregas.index')->with('msg-success', 'Produto entregue com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
