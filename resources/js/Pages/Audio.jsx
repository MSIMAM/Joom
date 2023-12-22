import React, { useState } from 'react'
// import Player from '@/Components/Player'
import AudioMusic from '@/Components/AudioMusic'

const App = () =>{
    const [musicNumber, setMusicNumber] = useState(0)
    return (
        <div>
            <AudioMusic props={{ musicNumber, setMusicNumber }} />
        </div>
    );
}

export default App;