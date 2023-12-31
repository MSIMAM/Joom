import * as React from 'react';
import { styled, useTheme } from '@mui/material/styles';
import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Slider from '@mui/material/Slider';
import IconButton from '@mui/material/IconButton';
import Stack from '@mui/material/Stack';
import PauseRounded from '@mui/icons-material/PauseRounded';
import PlayArrowRounded from '@mui/icons-material/PlayArrowRounded';
import FastForwardRounded from '@mui/icons-material/FastForwardRounded';
import FastRewindRounded from '@mui/icons-material/FastRewindRounded';
import VolumeUpRounded from '@mui/icons-material/VolumeUpRounded';
import VolumeDownRounded from '@mui/icons-material/VolumeDownRounded';
import Data from '@/js/index';


// const WallPaper = styled('div')({
//     position: 'absolute',
//     width: '100%',
//     height: '100%',
//     top: 0,
//     left: 0,
//     overflow: 'hidden',
//     background: 'linear-gradient(rgb(255, 38, 142) 0%, rgb(255, 105, 79) 100%)',
//     transition: 'all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275) 0s',
//     '&:before': {
//         content: '""',
//         width: '140%',
//         height: '140%',
//         position: 'absolute',
//         top: '-40%',
//         right: '-50%',
//         background:
//             'radial-gradient(at center center, rgb(62, 79, 249) 0%, rgba(62, 79, 249, 0) 64%)',
//     },
//     '&:after': {
//         content: '""',
//         width: '140%',
//         height: '140%',
//         position: 'absolute',
//         bottom: '-50%',
//         left: '-30%',
//         background:
//             'radial-gradient(at center center, rgb(247, 237, 225) 0%, rgba(247, 237, 225, 0) 70%)',
//         transform: 'rotate(30deg)',
//     },
// });

const Widget = styled('div')(({ theme }) => ({
    padding: 16,
    borderRadius: 16,
    width: 343,
    position: 'relative',
    zIndex: 1,
    backgroundColor:
        theme.palette.mode === 'dark' ? 'rgb(0,0,0)' : 'rgb(0,0,0)',
    backdropFilter: 'blur(40px)',
}));

const CoverImage = styled('div')({
    width: 100,
    height: 100,
    objectFit: 'cover',
    overflow: 'hidden',
    flexShrink: 0,
    borderRadius: 8,
    backgroundColor: 'rgba(0,0,0,0.08)',
    '& > img': {
      width: '100%',
      height: 100,
      objectFit: 'cover',
    },
});

const TinyText = styled(Typography)({
    fontSize: '0.75rem',
    opacity: 0.38,
    fontWeight: 500,
    letterSpacing: 0.2,
    color: 'white'
});

const MusicPlayerSlider = ({ props: { musicNumber, setMusicNumber } }) => {
    const theme = useTheme();
    const [position, setPosition] = React.useState(0);
    const [paused, setPaused] = React.useState(true);
    const [duration, setDuration] = React.useState(null);
    const [volume, setVolume] = React.useState(50); // Added volume state
    const musicList = Data[musicNumber].src;
    const audioRef = React.useRef(new Audio(musicList));



    // Set the duration when the audio metadata is loaded
    React.useEffect(() => {
        const handleLoadedMetadata = () => {
            setDuration(audioRef.current.duration);
        };

        const handleTimeUpdate = () => {
            setPosition(audioRef.current.currentTime);
        };

        audioRef.current.addEventListener('loadedmetadata', handleLoadedMetadata);
        audioRef.current.addEventListener('timeupdate', handleTimeUpdate);

        return () => {
            audioRef.current.removeEventListener('loadedmetadata', handleLoadedMetadata);
            audioRef.current.removeEventListener('timeupdate', handleTimeUpdate);
        };
    }, []);


    const formatDuration = (value) => {
        const minute = Math.floor(value / 60);
        const secondLeft = Math.floor(value - minute * 60);
        return `${minute}:${secondLeft < 10 ? `0${secondLeft}` : secondLeft}`;
    };

    const mainIconColor = theme.palette.mode === 'dark' ? '#fff' : '#000';
    const lightIconColor =
        theme.palette.mode === 'dark' ? 'rgba(255,255,255,0.4)' : 'rgba(0,0,0,0.4)';

    const handlePlayPause = () => {
        if (paused) {
            audioRef.current.play();
        } else {
            audioRef.current.pause();
        }
        setPaused(!paused);
    };

    const handleSliderChange = (e) => {
        const currentTime = Number(e.target.value)
        audioRef.current.currentTime = currentTime;
        setPosition(currentTime);
        //   console.log(e.target.value);
    };


    const handleVolumeChange = (_, value) => {
        setVolume(value);
        audioRef.current.volume = value / 100;
    };

    const handleNextPrevSong = (n) => {
        setMusicNumber((value) => {
          const newIndex = (value + n + Data.length) % Data.length;
          audioRef.current.src = Data[newIndex].src;
          audioRef.current.play(); // Auto-play the next song
          setPaused(false);
          return newIndex;
        });
    };
    return (
        <Box sx={{ width: '100%', overflow: 'hidden' }}>
            <Widget>
                <Box sx={{ display: 'flex', alignItems: 'center' }}>
                    <CoverImage>
                        <img
                            alt="can't win - Chilling Sunday"
                            src={Data[musicNumber].thumbnail}
                        />
                    </CoverImage>
                    <Box sx={{ ml: 1.5, minWidth: 0 }}>
                        <Typography variant="caption" sx={{color: 'white'}} fontWeight={500}>
                            Jun Pulse {Data.length}
                        </Typography>
                        <Typography sx={{color: 'white'}} noWrap>
                            <b>{Data[musicNumber].title}</b>
                        </Typography>
                        <Typography sx={{color: 'white'}} noWrap letterSpacing={-0.25}>
                            {Data[musicNumber].artist}
                        </Typography>
                    </Box>
                </Box>
                <Slider
                    aria-label="time-indicator"
                    size="small"
                    value={position}
                    min={0}
                    step={1}
                    max={duration}
                    onChange={e => handleSliderChange(e)}
                    sx={{
                        color: theme.palette.mode === 'dark' ? '#fff' : 'rgba(0,0,0,0.87)',
                        height: 4,
                        '& .MuiSlider-thumb': {
                          width: 8,
                          height: 8,
                          transition: '0.3s cubic-bezier(.47,1.64,.41,.8)',
                          '&:before': {
                            boxShadow: '0 2px 12px 0 rgba(0,0,0,0.4)',
                          },
                          '&:hover, &.Mui-focusVisible': {
                            boxShadow: `0px 0px 0px 8px ${
                              theme.palette.mode === 'dark'
                                ? 'rgb(255 255 255 / 16%)'
                                : 'rgb(0 0 0 / 16%)'
                            }`,
                          },
                          '&.Mui-active': {
                            width: 20,
                            height: 20,
                          },
                        },
                        '& .MuiSlider-rail': {
                          opacity: 0.28,
                        },
                      }}
                />
                <Box
                    sx={{
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'space-between',
                        mt: -2,
                    }}
                >
                    <TinyText>{formatDuration(position)}</TinyText>
                    <TinyText>-{formatDuration(duration - position)}</TinyText>
                </Box>
                <Box
                    sx={{
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        mt: -1,
                    }}
                >
                    <IconButton aria-label="previous song">
                        <FastRewindRounded fontSize="large" htmlColor={mainIconColor} onClick={() => handleNextPrevSong(-1)} />
                    </IconButton>
                    <IconButton
                        aria-label={paused ? 'play' : 'pause'}
                        onClick={handlePlayPause}
                    >
                        {paused ? (
                            <PlayArrowRounded
                                sx={{ fontSize: '3rem' }}
                                htmlColor={mainIconColor}
                            />
                        ) : (
                            <PauseRounded sx={{ fontSize: '3rem' }} htmlColor={mainIconColor} />
                        )}
                    </IconButton>
                    <IconButton aria-label="next song">
                        <FastForwardRounded fontSize="large" htmlColor={mainIconColor} onClick={() => handleNextPrevSong(1)} />
                    </IconButton>
                </Box>
                <Stack spacing={2} direction="row" sx={{ mb: 1, px: 1 }} alignItems="center">
                    <VolumeDownRounded htmlColor={lightIconColor} />
                    <Slider
                        aria-label="Volume"
                        defaultValue={50}
                        onChange={handleVolumeChange}
                        sx={{
                            color: theme.palette.mode === 'dark' ? '#fff' : 'rgba(0,0,0,0.87)',
                            '& .MuiSlider-track': {
                                border: 'none',
                            },
                            '& .MuiSlider-thumb': {
                                width: 24,
                                height: 24,
                                backgroundColor: '#fff',
                                '&:before': {
                                    boxShadow: '0 4px 8px rgba(0,0,0,0.4)',
                                },
                                '&:hover, &.Mui-focusVisible, &.Mui-active': {
                                    boxShadow: 'none',
                                },
                            },
                        }}
                    />
                    <VolumeUpRounded htmlColor={lightIconColor} />
                </Stack>
                {/* <p>{musicList}</p> */}
            </Widget>
            {/* <WallPaper /> */}

        </Box>
    );
}

export default MusicPlayerSlider;